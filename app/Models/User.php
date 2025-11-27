<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Gate;
use App\Models\Livre;
use App\Models\Commande;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Only allow access for the 'admin' panel when gate allows it
        if ($panel->getId() === 'admin') {
            return Gate::allows('access-admin'); // uses your Gate from AppServiceProvider
            return $this->is_admin === 1;
        }
        // Allow other panels by default (adjust as needed)
        return true;
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function livre()
    {
        return $this->belongsToMany(Livre::class, 'panier', 'livre_id', 'user_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
