<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class LanguageFormRequest extends FormRequest
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
        $rule = [] ; 
        // $id  = $this->get('id');

        $rules = [
            'name' => 'required|string|max:191',

            'code' => ['required', 'required','max:191' ,'string',
                Rule::unique('languages','code')->where('deleted_at', null)
            ],
            'locale' => 'required|string|max:191',   
        ];

        if ($request->method() == 'PUT') {
            $rules['code'] = ['required','max:191' ,'string',
                Rule::unique('languages','code')->where('deleted_at', null)->ignore($this->language->id)
            ];

        }

        return $rules;

    }
    
   

}