<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $user = auth()->user();

        $balance = calculateAvailableBalance($user->id);
        $investments = Investment::where('user_id', $user->id)->where('status', 'approved')->sum('amount');
        $loans = abs(calculateUserLoanAccountBalance($user->id));
        $withdraws = Withdraw::where('user_id', $user->id)->where('status', 'pending')->count();

        return view('user.dashboard', compact('balance', 'investments', 'loans', 'withdraws'));
    }
}
