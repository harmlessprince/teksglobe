<?php

namespace App\Http\Requests;

use App\Rules\CheckPin;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            'email' => [
                'required',
                'string',
                // Rule::exists('users', 'email')->where(function ($query) {
                //     $query->orWhere('mobile', $this->email);
                // }),
            ],
            'pin' => ['required', 'numeric', new CheckPin],
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

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, respondWithError($validator->errors(), 'An error occured', 422)));
    }
}
