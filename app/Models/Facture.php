<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = ['commande_id' , 'montant_total' , 'statut' ,'date_emission' ,'date_paiement'];
    public function commande (){
        return $this->belongsTo(Commande::class);
    }
}
