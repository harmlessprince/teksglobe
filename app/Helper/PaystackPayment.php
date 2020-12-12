<?php

namespace App\Helper;

use App\Interfaces\IGateway;
use App\Models\Payment;

/**
 * Undocumented class
 */
class PaystackPayment implements IGateway
{
    public function prepareTransaction($amount, $destination, $info = null): Payment {
        $reference = generatePaymentReference();
        $percentageCharge = config('paystack.charge');
        $charge = ($percentageCharge) ? ($amount * $percentageCharge) / 100 : 0;
        // Write Into Transaction
        $payment = new Payment;
        $payment->user_id = auth()->user()->id;
        $payment->reference = $reference;
        $payment->amount = $amount * 100;
        $payment->charge = $charge * 100;
        $payment->destination = $destination;
        $payment->info = $info;
        $payment->save();
        return $payment;
    }

    public function verify($reference) {
        $privateKey = config('paystack.secret');
        $check = ['status' => false, 'error' => 'Unknown Error'];
        $curl = curl_init();
        $curlSetOpt = [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer $privateKey",
            "cache-control: no-cache"
            ]
        ];
        if(config('app.env') !== 'production') $curlSetOpt[CURLOPT_SSL_VERIFYPEER] = false;
        curl_setopt_array($curl, $curlSetOpt);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            $check = ['status' => false, 'error' => $err];
        }
        else {
            $tranx = json_decode($response);
            if(!$tranx->status){
                $check = ['status' => false, 'error' => $tranx->message];
            }

            if('success' == $tranx->data->status){
                $check = ['status' => $tranx->data, 'error' => null];
            }
        }
        return $check;
    }
}
