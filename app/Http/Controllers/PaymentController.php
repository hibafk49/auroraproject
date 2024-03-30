<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class PaymentController extends Controller
{
    public function showPaymentPage($commandeId)
    {
        // Récupérez les détails de la commande
        $commande = Commande::findOrFail($commandeId);
        $total = $commande->total;
        // Passez les détails de la commande à la vue de paiement
        return view('payment', compact('commande','total'));
    }
}
