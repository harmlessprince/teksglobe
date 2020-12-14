<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBankAccountRequest;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
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
        $bank = auth()->user()->bank()->first();
        return view('user.bank.create', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddBankAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBankAccountRequest $request)
    {
        ['name' => $account_name, 'bank' => $bank_name, 'number' => $account_number] = $request->validated();

        BankAccount::firstOrCreate(['user_id' => auth()->user()->id], [
            'bank_name' => $bank_name,
            'account_name' => $account_name,
            'account_number' => $account_number,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('success', 'Bank account added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        //
    }
}
