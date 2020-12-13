<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyPackage;
use App\Http\Requests\UpdateInvestment;
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
            ->where('status', 'approved')
            ->leftJoin('interests', 'interests.investment_id', '=', 'investments.id')
            ->groupBy('investments.id')
            ->get();
        return view('user.investment.index', compact('investments'));
    }

    public function adminIndex ()
    {
        $investments = Investment::get();
        return view('admin.investment.index', compact('investments'));
    }

    public function pendingInvestments()
    {
       $investments = Investment::where('status', '=', 'pending')->get();
       return view('admin.investment.pending', compact('investments'));

    }
    public function declinedInvestments()
    {
        $investments = Investment::where('status', '=', 'declined')->get();
        return view('admin.investment.declined', compact('investments'));
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
     * @param  \App\Models\Package  $package
     * @param  \App\Http\Requests\BuyPackage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Package $package, BuyPackage $request)
    {
        // dd('5');
        $user = auth()->user();
        $data = [
            'user_id' => $user->id,
            'package_id' => $package->id,
            'amount' => $package->amount,
            'balance' => $package->amount * 2,
            'gateway' => $request->gateway,
        ];
        if ($request->gateway === 'bank') {
            $data['info'] = ['name' => $request->name, 'amount' => $request->amount];
        }
        if ($request->gateway === 'wallet') {
            if (calculateAvailableBalance($user->id) < $package->amount) {
                return back()->with('error', 'Insufficient Funds');
            }
            $data['status'] = 'approved';
            $data['verified_at'] = now();
        }
        $investment = Investment::create($data);
        // TODO:
        // $user->notify(new InvestmentNotification($investment));
        return redirect()->route('user.packages.index')->with('success', 'Investment Made!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        if ($investment->user_id !== auth()->user()->id) {
            return abort(403);
        }
        $investment->load('interests');
        return view('user.investment.show', compact('investment'));
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
    public function update(UpdateInvestment $request, Investment $investment)
    {
        //
        [
            'status' => $status,
        ] = $request->validated();

        $investment->status = $status;
        $investment->verified_by = auth()->user()->id;
        $investment->verified_at = now();
        $investment->save();
        return back()->with('success', 'Investment updated');
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
