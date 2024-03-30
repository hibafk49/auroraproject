<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;
use App\Models\Produit;

class DetailCommande extends Model
{
    use HasFactory;
    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        // Ajoutez ici d'autres colonnes de la table detail_commandes
    ];

    /**
     * Relation avec la commande à laquelle ce détail appartient.
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * Relation avec le produit lié à ce détail.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
