<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_id', 'plan_name', 'minimum', 'maximum', 'percentage', 'repeat', 'status', 'start_duration',
    ];

    public function invests()
    {
        return $this->hasMany(Investment::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
