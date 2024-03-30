<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
class Couleur extends Model
{
    use HasFactory;

    protected $fillable = ['id',
        'nom',
    ];

    public function produits() {
        return $this->belongsToMany(Produit::class, 'couleur_produit')->withPivot('stock');
    }
}
