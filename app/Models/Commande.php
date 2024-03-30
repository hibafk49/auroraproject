<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailsCommande;
use App\Models\User;
class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'utilisateur_id',
        'total',
        'statut',
        // Ajoutez ici d'autres colonnes de la table commande
    ];

    /**
     * Relation avec l'utilisateur qui a passé la commande.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les détails de commande.
     */
    public function details()
    {
        return $this->hasMany(DetailsCommande::class);
    }
}
