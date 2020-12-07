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

}
