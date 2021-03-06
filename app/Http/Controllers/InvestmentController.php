<?php

namespace App\Http\Controllers;

use App\Helper\PaystackPayment;
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
            // ->where('status', 'approved')
            ->leftJoin('interests', 'interests.investment_id', '=', 'investments.id')
            ->groupBy('investments.id')
            ->latest('verified_at')
            ->get();
        return view('user.investment.index', compact('investments'));
    }

    public function adminIndex ()
    {
        $investments = Investment::where('status', '=', 'approved')->get();
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
        if ($request->gateway === 'paystack') {
            $gateway = new PaystackPayment();
            $payment = $gateway->prepareTransaction($package->amount, 'investment', $package);
            return view('user.package.checkout', compact('payment', 'package'));
        }
        $user = auth()->user();
        $data = [
            'user_id' => $user->id,
            'package_id' => $package->id,
            'amount' => $package->amount,
            'returns' => $package->returns,
            'balance' => $package->returns,
            'gateway' => $request->gateway,
        ];
        if ($data['gateway'] === 'bank') {
            $data['info'] = ['name' => $request->name, 'amount' => $request->amount];
            $data['evidence'] = $request->file('evidence')->store('evidence', 'public');
        }
        if ($data['gateway'] === 'wallet') {
            if (calculateAvailableBalance($user->id) < $package->amount) {
                return back()->with('error', 'Insufficient Funds');
            }
            $data['status'] = 'approved';
            $data['verified_at'] = now();
        }
        $investment = Investment::create($data);
        if ($data['gateway'] === 'wallet') {
            $user->notify(new InvestmentNotification($investment));
        }
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
        if ((int)$investment->user_id !== (int)auth()->user()->id) {
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
        
        // check of user can update investment status
        $this->authorize('update', $investment);
        [
            'status' => $status,
        ] = $request->validated();
        
       
        $investment->status = $status;
        $investment->verified_by = auth()->user()->id;
        $investment->verified_at = now();
        $investment->save();
        if ($investment->status == 'approved') {
            return back()->with('success', 'Investment approved');
        }
        return back()->with('success', 'Investment declined');
       
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Yessss!!! I am authorized',
        // ]);
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
