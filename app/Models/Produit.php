<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Couleur;
class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'image_path',
        'prix',
        'collection_id',
        'couleur_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'collection_id');
    }

    public function couleurs()
    {
        return $this->belongsToMany(Couleur::class, 'couleur_produit')->withPivot('stock');
    }
}
