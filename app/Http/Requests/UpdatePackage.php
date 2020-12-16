<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:packages,name,'.$this->route('package')->id,
            'amount' => 'bail|required|numeric|min:1',
            'returns' => 'bail|required|numeric|min:'.$this->amount,
            'status' => 'required|boolean',
        ];
    }
}
