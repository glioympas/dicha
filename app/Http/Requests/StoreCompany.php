<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //We are covered with the middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:40',
            'email' => 'required|email',
            'activity' => 'nullable|string|min:3|max:100',
            'website' => 'nullable|string|url',
            'logo' => 'nullable|image|mimes:png|max:200000'
        ];
    }
}
