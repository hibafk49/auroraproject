<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id', 'pourcentage_reduction', 'date_debut', 'date_fin'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
