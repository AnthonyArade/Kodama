<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'type',
        'is_active',
    ];

    protected $casts = [
    'end_date' => 'datetime',
    'start_date' => 'datetime',
];

    public function scopeActiveNow($query)
    {
        $now = now();

        return $query->where('is_active', true)
                     ->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now);
    }
}
