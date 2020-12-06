<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'compound',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
