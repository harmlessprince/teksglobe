<?php

namespace App\Interfaces;

use App\Models\Payment;

/**
 * Interface any payment gateway must implement
 */
interface IGateway {
    /**
     * Prepare a transaction for payment
     *
     * @return void
     */
    public function prepareTransaction($amount, $destination, $info = null): Payment;

    /**
     * Verify a payment transaction
     *
     * @return void
     */
    public function verify($refernce);
}
