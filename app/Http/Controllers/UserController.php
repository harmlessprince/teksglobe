<?php

namespace App\Http\Controllers;

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
}
