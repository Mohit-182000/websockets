<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class CareerLevelsFormRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('career_levels', 'name')
            ],
        ];

        if ($request->method() == 'PUT') {
            $rules['name'] = [
                'required',
                Rule::unique('career_levels', 'name')->ignore($id)
            ];
        }

        return $rules;
    }
}
