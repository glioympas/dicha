<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompany;
use App\Models\Company;
use App\Notifications\CompanyUpdateNotification;
use Illuminate\Http\Request;
use Str;

class CompanyController extends Controller
{
    

    public function index(Request $request)
    {
        $companies = Company::with('employees')->latest();

        if($request->term) {
            $companies->where(function($query) use($request) {
                $query->where('name', 'like', '%' . $request->term . '%')->orWhere('email', 'like', '%' . $request->term . '%')->orWhere('id', '=', $request->term);
            });
        }

        $allCount = $companies->count();
        $companies = $companies->paginate(15);

        return view('companies.index', compact('companies' , 'allCount'));
    }


    public function create()
    {
        return view('companies.company_form');
    }

    public function store(StoreCompany $request)
    {
        $company = new Company;
        $company->fill($request->all());

        if($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $name = Str::random(6) . str_replace(" ", "", microtime()) . "." . $logo->extension();
            $logo->move(public_path() . "/company_logos/" , $name);
            $company->logo = $name;
        }

        $company->save();

        session()->flash('success', __("Company has been created successfully."));

        auth()->user()->notify(new CompanyUpdateNotification($company , true));

        return response()->json(['redirect' => route('companies.edit', $company->id)]);
    }

  
    public function show(Company $company)
    {
        return view('companies.company_form', ['company' => $company , 'show' => true] );
    }

  
    public function edit(Company $company)
    {
        return view('companies.company_form', compact('company'));
    }

    public function update(StoreCompany $request, Company $company)
    {
        $company->fill($request->except('logo'));

        if($request->hasFile('logo') || $request->remove_image == 1) {

            //Delete Old One
            if($company->logo && !filter_var($company->logo, FILTER_VALIDATE_URL)) {
                $oldPath = public_path() . "/company_logos/" . $company->logo;
                if(file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            if($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = Str::random(6) . str_replace(" ", "", microtime()) . "." . $logo->extension();
                $logo->move(public_path() . "/company_logos/" , $name);
                $company->logo = $name;
            }
        }

        if($request->remove_image == 1) {
            $company->logo = null;
        }

        $company->save();

        auth()->user()->notify(new CompanyUpdateNotification($company));

        return response()->json(['success' => __("Company has been updated successfully.") ]);
    }

 
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['success' => __("Company $company->name has been deleted successfully.")]);
    }
}
