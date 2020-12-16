<?php

namespace App\Rules;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

class CheckPin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return $value === Crypt::decryptString(auth()->user()->pin);
        } catch (DecryptException $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect pin';
    }
}
