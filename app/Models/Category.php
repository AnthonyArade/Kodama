<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Livre;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom'
    ];
    //definir relation avec livres
    public function livres()
    {
        return $this->hasMany(Livre::class);
    }
}
