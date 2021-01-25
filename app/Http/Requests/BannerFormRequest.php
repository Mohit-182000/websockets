<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BannerFormRequest extends FormRequest
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
            'title' => 'required|string|max:191',
            'description' => 'required|max:300',   

            'image' => 'required|dimensions:width=1920,height=500',


    ];


  if ($request->method() == 'PUT') {
       $rules['image'] = 'sometimes|required|dimensions:width=1920,height=500';

     }

    
        return $rules;

    }
    
   

}