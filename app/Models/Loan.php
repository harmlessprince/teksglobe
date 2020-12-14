<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * Get the investment that owns the loan.
     */
    public function investment()
    {
        return $this->belongsTo('App\Models\Investment');
    }

    /**
     * Get the User that owns the loan.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
