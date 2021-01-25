<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;

class KnowledgeBankFormRequest extends FormRequest
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
            'title' => [
                'required',
                Rule::unique('knowledge_banks', 'title')
            ],

            'file' => [
                'required_without:link',
            ],
            
            'link' => [
                'required_without:file',  
            ],
         
            'file' => 'mimes:doc,pdf,docx,jpeg,jpg', 
   
            'description' => 'required',
        ];

        if ($request->method() == 'PUT') {
            $rules['title'] = [
                'required',
                Rule::unique('knowledge_banks', 'title')->ignore($id)
            ];
            $rules['file'] = [
                'sometimes'
            ];
           
            $rules['link'] = [
                'sometimes'
            ];
        }

        return $rules;
    }

}
