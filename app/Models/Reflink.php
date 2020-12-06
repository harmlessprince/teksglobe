<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflink extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','link',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function referrals(){
        return $this->hasMany(Referral::class);
    }
}
