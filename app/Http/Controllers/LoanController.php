<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLoan;
use App\Http\Requests\UpdateLoan;
use App\Models\Investment;
use App\Models\Loan;
use App\Notifications\LoanApprovedNotification;
use App\Notifications\LoanDeclinedNotification;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::where('user_id', auth()->user()->id)
            ->with('investment')
            ->latest()
            ->get();
        return view('user.loan.index', compact('loans'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed()
    {
        $loans = Loan::where('status', '=', 'completed')
            ->latest()
            ->get();
        return view('admin.loan.completed', compact('loans'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        
        $loans = Loan::where('status', '=', 'pending')
            ->latest()
            ->get();
        return view('admin.loan.pending', compact('loans'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declined()
    {
        $loans = Loan::where('status', '=', 'declined')
            ->with('investment')
            ->latest()
            ->get();
        return view('admin.loan.declined', compact('loans'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $loans = Loan::where('status', '=', 'approved')
            ->latest()
            ->get();
        return view('admin.loan.approved', compact('loans'));
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
     * @param  \App\Http\Requests\RequestLoan  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function store(RequestLoan $request, Investment $investment)
    {
        ['amount' => $amount] = $request->validated();

        Loan::create([
            'user_id' => auth()->user()->id,
            'investment_id' => $investment->id,
            'amount' => $amount,
            'charge' => calculateInterestOnLoan($amount),
            'request_ip' => $request->ip(),
        ]);

        return back()->with('success', 'Loan application successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoan $request, Loan $loan)
    {
        //
        $this->authorize('update', $loan);
        [
            'status' => $status,
        ] = $request->validated();

        $loan->status = $status;
        $loan->verified_by = auth()->user()->id;
        $loan->verified_at = now();
        $loan->save();
        //
        creditInterestTable($loan->user_id, $loan->amount, 'Loan Approved');
        debitLoanAccountTable($loan->user_id, $loan->amount, 'Loan Booking', $loan->investment_id);
        debitLoanAccountTable($loan->user_id, $loan->charge, ' Interest on Loan', $loan->investment_id);
        //
        // $loan->user->notify(new LoanApprovedNotification($loan));
        //
        return back()->with('success', 'Loan has been successfully Approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateLoan $request, Loan $loan)
    {

        // check of user can update loan status
        $this->authorize('update', $loan);
        //
        [
            'status' => $status,
            // 'narrration' => $narrration,
        ] = $request->validated();

        $loan->status = $status;
        $loan->verified_by = auth()->user()->id;
        $loan->verified_at = now();
        $loan->narration = $request->narration;
        $loan->save();
        //
        $loan->user->notify(new LoanDeclinedNotification($loan));
        //
        return back()->with('success', 'Loan has been successfully Declined');
    }
}
