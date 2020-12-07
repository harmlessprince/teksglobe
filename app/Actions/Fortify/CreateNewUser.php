<?php

namespace App\Actions\Fortify;

use App\Events\UserReferred;
use App\Models\Profile;
use App\Models\Reflink;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'password' => $this->passwordRules(),
        // ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'mobile' => ['required', 'string', 'max:255', Rule::unique(Profile::class),],
            'postcode' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $uuid = Str::uuid()->toString();
        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'pin' => substr(str_shuffle($permitted_chars), 0, 5),
            'admin' => 0,
            'active' => 0,
            'membership_started' => now(),
            'membership_expired' => now()->addYears(5),
        ]);

        Profile::create([

            'user_id' => $user->id,
            'mobile' => $input['mobile'],
            'postcode' => $input['postcode'],
            'avatar' => 'uploads/avatars/default.jpg',
            'main_balance' => config('settings.signup_bonus'),
        ]);

        Reflink::create([
            'user_id' => $user->id,
            'link' =>  Str::random(4) . $user->id . Str::random(4),
        ]);

        $user->sendEmailVerificationNotification();

        // $user->sendPhoneVerificationCode();

        // event(new UserReferred(request()->cookie('ref'), $user));
        return $user;
    }
}
