<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{

    protected $fillable = [
        'client_id',
        'montant_total',
        'statut',
        'stripe_payment_intent_id',
        'dateLivraison',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function achats()
    {
        return $this->hasMany(Achat::class);
    }
}
