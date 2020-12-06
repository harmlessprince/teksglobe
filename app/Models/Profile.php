<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'avatar',
        'mobile',
        'occupation',
        'address',
        'address2',
        'city',
        'state',
        'postcode',
        'country',
        'facebook',
        'about',
        'main_balance',
        'deposit_balance',
        'referral_balance',

    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAvatarAttribute($avatar)
    {

        return asset($avatar);
    }
}
