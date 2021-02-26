<?php

namespace App\Http\Requests;

use App\Rules\IdExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|email',
            'company_id' => ['required', 'integer', new IdExists('companies', __("Company"))],
            'phone' => 'nullable|string|min:10|max:20' //Με την λογική ότι μπορεί να έχει και ξένους αριθμούς (+ παρενθέσεις κλπ) οπότε το έβαλα στο περίπου το length
        ];
    }
}
