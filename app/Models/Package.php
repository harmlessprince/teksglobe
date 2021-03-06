<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

     /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get the package interest.
     */
    public function getInterestAttribute()
    {
        return ($this->returns * 100) / ($this->amount * 50);
    }
}
