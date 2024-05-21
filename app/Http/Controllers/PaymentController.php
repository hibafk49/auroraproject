<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class PaymentController extends Controller
{
    public function showPaymentPage($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        $total = $commande->total;
        return view('payment', compact('commande','total'));
    }
}
