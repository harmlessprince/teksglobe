<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLoan;
use App\Models\Investment;
use App\Models\Loan;
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
        return view('admin.loan.pending', compact('loans'));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Investment $investment)
    {
        if ($investment->user_id !== auth()->user()->id || $investment->hasActiveLoan()) {
            return abort(403);
        }

        $amount = $investment->loan_amount;
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
        [
            'status' => $status,
        ] = $request->validated();

        $loan->status = $status;
        $loan->verified_by = auth()->user()->id;
        $loan->verified_at = now();
        $loan->save();
        creditInterestTable($loan->user_id, $loan->amount, "fix this");
        return back()->with('success', 'Withdrawal has been successfully Approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateLoan $request, Loan $loan)
    {
        //
        [
            'status' => $status,
        ] = $request->validated();

        $loan->status = $status;
        $loan->verified_by = auth()->user()->id;
        $loan->verified_at = now();
        $loan->save();
        return back()->with('success', 'Withdrawal has been successfully Declined');
    }
}
