<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment public and secret key
    |--------------------------------------------------------------------------
    |
    */
    'public' => env('PAYMENT_PUBLIC_KEY'),
    'secret' => env('PAYMENT_SECRET_KEY'),
    'charge' => env('PAYMENT_CHARGE', 0),
    'transfer' => env('TRANSFER_FEE', 100),
];
