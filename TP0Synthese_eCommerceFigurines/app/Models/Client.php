<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = [
        'email',
        'nom',
        'prenom',
        'password',
        'adresse',
        'ville',
        'codePostal',
        'province',
        'telephone',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
