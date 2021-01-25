<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RolesFormRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:roles,name',
        ];

        if ($request->method() == 'PUT') {
            $rules['name'] = 'required|string|max:191|unique:roles,name,'.$this->role->id.'id';
        }

        return $rules;
    }
    
   

}