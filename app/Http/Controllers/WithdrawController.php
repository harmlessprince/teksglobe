<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWithdrawal;
use App\Http\Requests\WithdrawRequest;
use App\Models\Withdraw;
use App\Notifications\WithdrawalDeclinedNotification;
use Illuminate\Http\Request;

class WithdrawController extends Controller
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
     * Display a listing of the pending resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $withdraws = Withdraw::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();
        $bank = auth()->user()->bank()->first();
        return view('user.withdraw.pending', compact('withdraws', 'bank'));
    }

    /**
     * Display a listing of the approved resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $withdraws = Withdraw::where('user_id', auth()->user()->id)
            ->where('status', 'approved')
            ->get();
        return view('user.withdraw.approved', compact('withdraws'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank = (int)auth()->user()->bank()->exists();
        $pin = auth()->user()->hasPin();
        return view('user.withdraw.create', compact('bank', 'pin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WithdrawRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawRequest $request)
    {
        try {
            ['amount' => $amount, 'pin' => $pin] = $request->validated();

            Withdraw::create([
                'user_id' => auth()->user()->id,
                'amount' => $amount,
                'charge' => calculateChargeOnWithdrawal($amount),
                'request_ip' => $request->ip(),
            ]);
            return respondWithSuccess([], 'Withdrawal request successful');
        } catch (\Throwable $th) {
            return respondWithError([], $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWithdrawal $request, Withdraw $withdraw)
    {
        //

        [
            'status' => $status,
        ] = $request->validated();

        $withdraw->status = $status;
        $withdraw->verified_by = auth()->user()->id;
        $withdraw->verified_at = now();
        $withdraw->save();
        debitInterestTable($withdraw->user_id, $withdraw->amount, "Withdrawal approved");
        return back()->with('success', 'Withdrawal has been successfully Approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateWithdrawal $request, Withdraw $withdraw)
    {
        //
        [
            'status' => $status,
        ] = $request->validated();

        $withdraw->status = $status;
        $withdraw->verified_by = auth()->user()->id;
        $withdraw->verified_at = now();
        $withdraw->narration = $request->narration;
        $withdraw->save();
        $withdraw->user()->notify(new WithdrawalDeclinedNotification());
        return back()->with('success', 'Withdrawal has been successfully Declined');
    }

    /**
     * Displays teh linsting of the specified resource status from storage to pending.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function pendingWithdrawal()
    {
        $pending_withdrawals = Withdraw::where('status', '=', "pending")->get();
        return view('admin.withdraw.pending', compact('pending_withdrawals'));
    }

    /**
     *  Displays teh linsting of the specified resource status from storage to approved.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function approvedWithdrawal()
    {
        $approved_withdrawals = Withdraw::where('status', '=', "approved")->get();
        return view('admin.withdraw.approved', compact('approved_withdrawals'));
    }

    /**
     *  Displays teh linsting of the specified resource status from storage to approved.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function declinedWithdrawal()
    {
        $declined_withdrawals = Withdraw::where('status', '=', "declined")->get();
        return view('admin.withdraw.declined', compact('declined_withdrawals'));
    }
}
