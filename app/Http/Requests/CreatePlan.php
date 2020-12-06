<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 
        if (auth()->user()->admin == true) {
            return  true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan_name' => 'required|max:100',
            'style_id' => 'required|numeric|min:1|max:200',
            'minimum' => 'required|numeric|min:1',
            'maximum' => 'required|numeric|min:1',
            'percentage' => 'required|numeric',
            'repeat' => 'required|numeric|min:1',
            'start_duration' => 'required|numeric',
            'status' => 'required|boolean',
        ];
    }
}
