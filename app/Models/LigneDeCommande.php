<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Livre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Commande;

class LigneDeCommande extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'livre_id',
        'quantite',
    ];
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
