<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
