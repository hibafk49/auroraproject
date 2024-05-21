<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FactureEnvoyee;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\User;

class PaymentController extends Controller
{
    public function showPaymentPage($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        $total = $commande->total;
        return view('payment', compact('commande', 'total'));
    }

    public function processPayment(Request $request)
    {
        $orderID = $request->orderID;
        $payerID = $request->payerID;

        Log::info('Received orderID: ' . $orderID); 

        $commande = Commande::find($orderID);

        if (!$commande) {
            return response()->json(['error' => 'Commande introuvable'], 404);
        }

        Log::info('Commande trouvée: ' . $commande->id); 

        $paiement = new Paiement();
        $paiement->commande_id = $commande->id;
        $paiement->montant = $commande->total;
        $paiement->methode_paiement = 'PayPal';
        $paiement->statut = 'Complété';
        $paiement->date_paiement = now();
        $paiement->save();

        Log::info('Paiement enregistré: ' . $paiement->id);

        $facture = new Facture();
        $facture->commande_id = $commande->id;
        $facture->montant_total = $commande->total;
        $facture->date_emission = now();
        $facture->statut = 'payee';
        $facture->save();

        $commande->update(['statut' => 'Paiement reçu']);

        Mail::to($commande->utilisateur->email)->send(new FactureEnvoyee($facture));

        return response()->json(['success' => true]);
    }
}
