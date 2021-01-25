<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminesFormRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',           // required and has to match the password field
            'type' => 'required',

        ];

        if ($request->method() == 'PUT') {
            unset($rules['confirm_password'], $rules['password']);
            $rules['email'] = 'required|email|unique:admins,email,' . $this->user->id . 'id';
        }

        return $rules;

    }


}
