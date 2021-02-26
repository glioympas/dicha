<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Models\Company;
use App\Models\Employee;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{
    
    public function index(Request $request)
    {
        $employees = Employee::with('company')->latest();
        $company = null;

        if($companyId = $request->company_id) {
            $company = Company::findOrFail($companyId);
            $employees->where('company_id', '=', $companyId);
        }

        if($request->term) {
            $employees->where(function($query) use($request) {
                $query->where('name', 'like', '%' . $request->term . '%')->orWhere('email', 'like', '%' . $request->term . '%')->orWhere('id', '=', $request->term)
                      ->orWhereHas('company', function($query) use($request) {
                    $query->where('name', 'like', '%'  . $request->term . '%');
                })
                ;
            });
        }

        $allCount = $employees->count();
        $employees = $employees->paginate(15);

        return view('employees.index', compact('employees', 'allCount', 'company'));
    }

    public function create()
    {
        $allCompanies = Company::allCompanies();

        return view('employees.employee_form', compact('allCompanies'));
    }

  
    public function store(StoreEmployee $request)
    {
        $employee = Employee::create($request->all());
        session()->flash('success' , __("Employee has been created successfully."));

        return response()->json(['redirect' => route('employees.edit', $employee->id)]);
    }

    public function show(Employee $employee)
    {
        return view('employees.employee_form', ['employee' => $employee , 'show' => true]);
    }

 
    public function edit(Employee $employee)
    {
        $allCompanies = Company::allCompanies();

        return view('employees.employee_form', compact('employee', 'allCompanies'));
    }

 
    public function update(StoreEmployee $request , Employee $employee)
    {
        $employee->update($request->all());
        return response()->json(['success' => __("Employee has been updated successfully.")]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['success' => __("Employee $employee->name has been deleted successfully.")]);
    }
}
