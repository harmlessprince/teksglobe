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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     /**
     * Get the user verifying the investment
     */
    public function verifiedBy()
    {
        return $this->belongsTo('App\Models\User', 'verified_by');
    }

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
    public function getCompletionAttribute()
    {
        return (($this->returns - $this->balance) / $this->returns) * 100;
    }

    public function isRunning()
    {
        // dump($this->verified_at->diffInDays(now()));
        return $this->verified_at && $this->verified_at->diffInDays(now()) >= 30;
    }

    /**
     * Get the investment current badge.
     */
    public function getBadgeAttribute()
    {
        if (!$this->verified_at) {
            return ['text' => ucfirst($this->status), 'color' => 'dark'];
        }
        if (!$this->isRunning()) {
            return ['text' => 'Incubation', 'color' => 'secondary'];
        }
        return ($this->balance > 0) ? ['text' => 'Running', 'color' => 'primary'] : ['text' => 'Completed', 'color' => 'success'];
    }

    /**
     * Get the loan record for the investment.
     */
    public function loan()
    {
        return $this->hasMany('App\Models\Loan');
    }

    public function canTakeLoan()
    {
        return $this->isRunning() && $this->availableLoanAmount() > 0;
    }

    public function availableLoanAmount()
    {
        return ($this->amount / 2) - $this->loan()->whereIn('status', ['pending', 'approved'])->sum('amount');
    }
}
