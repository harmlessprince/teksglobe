<?php

namespace App\Http\Requests;

use App\Rules\CheckPin;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePin extends FormRequest
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
    public function rules()
    {
        $data = [
            'pin' => 'required|numeric|digits:4|confirmed',
            'password' => 'required|string|password',
        ];

        if (auth()->user()->hasPin()) {
            $data['current_pin'] = ['required', 'numeric', new CheckPin];
        }

        return $data;
    }
}
