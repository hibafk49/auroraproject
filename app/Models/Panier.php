<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produit_id', 'quantite', 'couleur_id'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }
}
