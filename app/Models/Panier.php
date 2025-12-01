<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = [
        'user_id',
        'livre_id',
        'quantite',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the livre (book) that is in the cart.
     */
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
}
