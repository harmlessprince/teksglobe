<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            //return [
            
                'name' => 'required|max:100|unique:packages',
                'amount' => 'required|numeric|min:1',
                'interest' => 'required|numeric',
                'status' => 'required|boolean',
            ];
        
    }
}
