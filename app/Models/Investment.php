<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
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
        'info' => 'json',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the package that owns the investment.
     */
    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

    /**
     * Get the interests gained on the investment.
     */
    public function interests()
    {
        return $this->hasMany('App\Models\Interest');
    }

    /**
     * Get the investment expected total.
     */
    public function getTotalAttribute()
    {
        return $this->amount * 2;
    }

    /**
     * Get the investment expected total.
     */
    public function getCompletionAttribute()
    {
        return (($this->total - $this->balance) / $this->total) * 100;
    }

    /**
     * Get the investment current badge.
     */
    public function getBadgeAttribute()
    {
        if ($this->verified_at->diffInDays(now()) <= 30) {
            return 'Incubation';
        }
        return ($this->balance > 0) ? 'Running' : 'Completed';
    }

    /**
     * Get the amount can be taken as loan on investment.
     */
    public function getLoanAmountAttribute()
    {
        return $this->amount / 2;
    }

    /**
     * Get the loan record for the investment.
     */
    public function loan()
    {
        return $this->hasMany('App\Models\Loan');
    }

    public function hasActiveLoan()
    {
        return $this->loan()->where('status', '<>', 'declined')->exists();
    }
}
