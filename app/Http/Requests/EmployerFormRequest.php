<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;

class EmployerFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rule = [];
        $id  = $this->get('id');


        $rules = [
            'company_name' => [
                'required'
            ],

            'email' => [
                'required'
            ],
         
            'profile_image' => 'required|sometimes|mimes:jpeg,jpg,png', 
   
            'company_type' => 'required',

            'about_company' => 'required',
            'company_address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'locality' => 'required',
        ];

        if ($request->method() == 'PUT') {
            $rules['email'] = [
                'required',
                Rule::unique('users', 'email')->ignore($id)
            ];
            $rules['profile_image'] = [
                'sometimes'
            ];
        }

        return $rules;
    }
}
