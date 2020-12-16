<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMembershipActive;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = Route::currentRouteName();
        if ($path == "admin.membership.active") {
            $users = User::where('active', '=', true)->get();
            return view('admin.membership.active', compact('users'));
        } elseif ($path == "admin.membership.inactive") {
            $users = User::where('active', '=', false)->get();
            return view('admin.membership.inactive', compact('users'));
        } else {
            $users = User::all();
            return view('admin.membership.index', compact('users'));
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $user->load('bank');
        
        return view('admin.membership.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipActive $request, User $user)
    {
        //
        [
            'active' => $active,
        ] = $request->validated();

        $user->active = $active;
        $user->save();
        if ($user->active == true) {
            return back()->with('success', 'User has been successfully Activated');
        }
        return back()->with('success', 'User has been sucessfully Deactivated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
