<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class CategoryFormRequest extends FormRequest
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
                Rule::unique('categories', 'name')
            ],
        ];

        if ($request->method() == 'PUT') {
            $rules['name'] = [
                'required',
                Rule::unique('categories', 'name')->ignore($id)
            ];
            $rules['parent_id'] = [
                'parent_id' => 'not_in:' . $this->id,  
            ];
        }

        return $rules;
    }
}
