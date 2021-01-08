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
        $pin = auth()->user()->hasPin();
        return view('user.transfer.index', compact('pin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            ['user' => $user, 'amount' => $amount, 'email' => $email] = $request->all();
            debitInterestTable(auth()->user()->id, ($amount + calculateChargeOnTransfer($amount)), 'TRF/'.$user.'/'.$email);
            creditInterestTable($user, $amount,  'TRF/'.auth()->user()->id.'/'.auth()->user()->email);
            return respondWithSuccess([], 'Funds transfer successful');
        } catch (\Throwable $th) {
            return respondWithError([], $th->getMessage());
        }
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
        $account = DB::table('users')->select('id', 'name')->where('email', $email)->orWhere('mobile', $email)->first();
        return respondWithSuccess(['account' => $account, 'amount' => $amount, 'email' => $email]);
    }
}
