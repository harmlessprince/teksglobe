<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        $bank = auth()->user()->bank()->first();

        return view('user.profile.show', compact('user', 'bank'));
    }

    public function update(UpdateProfile $request)
    {
        $user = auth()->user();

        if ($request->certificate) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();

        return back()->with('success', 'Profile updated');
    }
}
