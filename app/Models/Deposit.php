<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id', 'user_id', 'gateway_name','amount','charge','net_amount','status','details', 'namesss', 'screenshot', 
    ];

     /**
     * Get the user record associated with the deposit.
     */
    public function user(){

        return $this->belongsTo('App\User');

    }
}
