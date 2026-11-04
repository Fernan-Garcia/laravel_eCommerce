<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = [
        'commande_id',
        'produit_id',
        'nom_produit',
        'prix_unitaire',
        'quantite',
        'total',
        'etat',
    ];
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Figurine::class);
    }
}
