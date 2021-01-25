<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CompanyTypeRequest extends FormRequest
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
            'company_type' => [
                'required',
                Rule::unique('company_types', 'company_type')
            ],
        ];

        if ($request->method() == 'PUT') {
            $rules['company_type'] = [
                'required',
                Rule::unique('company_types', 'company_type')->ignore($id)
            ];
        }

        return $rules;
    }
}
