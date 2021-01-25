<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ExamUpdatesFormRequest extends FormRequest
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
                Rule::unique('exam_updates', 'title')
            ],

            'no_of_post' => 'required|numeric',

            'fees' => 'required|numeric',

            'age_limit' => 'required',

            'last_date_of_exam' => 'required|date',

            'link' => 'required',

            'description' =>'required',
        ];

        if ($request->method() == 'PUT') {
            $rules['title'] = [
                'required',
                Rule::unique('exam_updates', 'title')->ignore($id)
            ];
        }

        return $rules;
    }
}
