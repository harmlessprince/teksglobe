<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.transfer.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ['user' => $user, 'amount' => $amount, 'email' => $email] = $request->all();
        debitInterestTable(auth()->user()->id, ($amount + calculateChargeOnTransfer($amount)), 'TRF/'.$user.'/'.$email);
        creditInterestTable($user, $amount,  'TRF/'.auth()->user()->id.'/'.auth()->user()->email);

        return redirect()->route('user.transfers.index')->with('success', 'Funds transfer successful');
    }

    /**
     * Confirm funds transfer.
     *
     * @param  \App\Http\Requests\TransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(TransferRequest $request)
    {
        ['email' => $email, 'amount' => $amount, 'pin' => $pin] = $request->validated();
        $account = DB::table('users')->select('id', 'name')->where('email', $email)->first();
        return view('user.transfer.confirm', ['account' => $account, 'amount' => $amount, 'email' => $email]);
    }
}
