<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LigneDeCommande;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nom',
        'auteur',
        'description',
        'image',
        'prix',
        'date_sortie',
        'stock',
        'like',
        'unlike'
    ];
    //definir relation avec category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ligne()
    {
        return $this->hasMany(LigneDeCommande::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'panier', 'livre_id', 'user_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
