<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Figurine extends Model
{
    // protected $table = "cartes";
    // protected $primaryKey = "carteId";
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'stock',
        'image_Path',
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
