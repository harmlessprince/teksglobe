<?php

namespace App\Http\Controllers;

use App\Helper\PaystackPayment;
use App\Models\Investment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Verify the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $subscription
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, PaystackPayment $gateway)
    {
        $reference = $request->reference;
        $payment = Payment::where('reference', $reference)->first();
        if (!$payment) {
            return redirect()->route('user.packages.index')->with('error', 'Payment record not found');
        }
        if ($payment->status) {
            return redirect()->route('user.packages.index')->with('error', 'Payment already resolved.');
        }
        ['status' => $status, 'error' => $error] = $gateway->verify($reference);
        if (!$status) {
            $payment->status = 'fail';
            $payment->response = ['status' => $status, 'error' => $error];
            $payment->save();
            return redirect()->route('user.packages.index')->with('error', $error);
        }
        $total = $payment->amount + $payment->charge;
        if ($total <= $status->amount && $status->status == 'success') {
            $payment->status = 'success';
            $payment->response = $status;
            $payment->save();
            if ($payment->destination === 'investment') {
                $investment = Investment::create([
                    'user_id' => $payment->user_id,
                    'package_id' => $payment->info->id,
                    'amount' => $payment->info->amount,
                    'balance' => $payment->info->returns,
                    'returns' => $payment->info->returns,
                    'gateway' => 'paystack',
                    'status' => 'approved',
                    'verified_at' => now(),
                ]);
                return redirect()->route('user.packages.index')->with('success', 'Payment successful');
            }
        } else {
            return redirect()->route('user.packages.index')->with('error', 'Payment Failed.');
        }
    }
}
