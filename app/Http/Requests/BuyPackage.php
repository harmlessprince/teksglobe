<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyPackage extends FormRequest
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
        if ($this->gateway === 'bank') {
            return [
                'name' => 'required|string',
                'amount' => 'required|numeric|min:1',
            ];
        }
        return [
            'gateway' => [
                'required',
                'string',
                Rule::in('wallet', 'bank', 'paystack'),
            ]
        ];
    }
}
