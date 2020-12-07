<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Package;
use App\Notifications\InvestmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investments = Investment::select('investments.*', DB::raw('SUM(interests.amount) as interests'))
            ->where('investments.user_id', auth()->user()->id)
            ->leftJoin('interests', 'interests.investment_id', '=', 'investments.id')
            ->groupBy('investments.id')
            ->get();
        return view('investment.index', compact('investments'));
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
     * @param  \App\Models\Investment  $investment
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Package $package, Request $request)
    {
        $investment = Investment::create([
            'user_id' => auth()->user()->id,
            'package_id' => $package->id,
            'amount' => $package->amount,
            'balance' => $package->amount * 2,
        ]);
        // TODO:
        // auth()->user()->notify(new InvestmentNotification($investment));
        return back()->with('success', 'Investment Made!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        $investment->load('interests');
        return view('investment.show', compact('investment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        //
    }
}
