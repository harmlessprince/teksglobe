<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
         
        // $user = Auth::user();
        $profile->load('user');
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        [
            'occupation' => $occupation,
            'address' => $address,
            'city'  => $city,
            'state' => $state,
            'postcode' => $postcode,
        ] = $request->validated();

        if(!Hash::check($request->input('current_password'), $profile->user->password)){
            return redirect()->back()->with('error','Your current password does not matches with the password you provided. Please try again.');
        }
        // if(strcmp($request->input('current_password'), $request->input('password')) == 0){
        //     session()->flash('message', 'New Password cannot be same as your current password. Please choose a different password.');
        //     // Session::flash('type', 'warning');
        //     // Session::flash('title', 'Password Same');
        //     return redirect()->back();
        // }
        
        if ($request->hasFile('avatar')) {
           
            $this->validate($request, [
                'avatar' => 'required|image|mimes:jpeg,bmp,png,jpg'
            ]);
           
            $avatar = $request->avatar;
            $avatar_new_name = time() . $avatar->getClientOriginalName();
            $avatar->move('uploads/avatars', $avatar_new_name);
            $profile->avatar = 'uploads/avatars/' . $avatar_new_name;
            $profile->save();
        }

        $profile->occupation = $occupation;
        $profile->address = $address;
        $profile->city = $city;
        $profile->state = $state;
        $profile->postcode = $postcode;
        $profile->country = $request->country;
        $profile->save();
        return back()->with('success', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
