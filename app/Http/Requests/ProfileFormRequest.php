<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;

class ProfileFormRequest extends FormRequest
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
        $id = Auth::guard('contact')->user()->id;


        $rules = [
            'email' => 'email|sometimes|nullable',
            'contact_name' => 'required',
            'name' => 'required',
        ];

//        $rules['name'] = ['required', 'string', Rule::unique('contacts', 'company')->whereNotNull('company')->where('cb_type', 'customer')->ignore($id)];

//        $rules['email'] = 'required|email|unique:contacts,name,' . $id;


        return $rules;
    }


}
