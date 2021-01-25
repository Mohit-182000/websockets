<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManageAddressRequest extends FormRequest
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
//            'shipping_first_name' => 'required',
//            'shipping_last_name' => 'required',
            'shipping_address_one' => 'required',
            'shipping_state_id' => 'required',
            'shipping_country_id' => 'required',
            'shipping_pincode' => 'required',
            'shipping_city' => 'required',
            'shipping_pincode' => 'required',
        ];


        return $rules;

    }



}
