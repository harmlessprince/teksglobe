<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pin = auth()->user()->hasPin();
        return view('user.pin.update', compact('pin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePin  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePin $request)
    {
        ['pin' => $pin] = $request->validated();

        $request->user()->fill([
            'pin' => Crypt::encryptString($pin),
        ])->save();

        return back()->with('success', 'Pin Updated Successfully');
    }
}
