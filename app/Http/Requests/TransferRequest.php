<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
        $balance = calculateAvailableBalance(auth()->user()->id);
        $charge = calculateChargeOnTransfer($this->amount);
        return [
            'amount' => 'bail|required|numeric|min:1|max:'.($balance - $charge),
            'email' => 'required|string|email|exists:users',
            'pin' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'amount.max' => 'Insufficient Funds',
            'email.exists' => 'Record Not Found',
        ];
    }
}
