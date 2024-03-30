<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
  use App\Models\Commande;
  use App\Models\Panier;
  use App\Models\DetailsCommande;
use Illuminate\Support\Facades\Auth;
class ConfirmationCommandeController extends Controller
{
   
    public function confirmationCommande()
    {
        // Obtenez le panier de la session
        $cart = session()->get('cart', []);
    
        $total = 0;
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $total += $item['product']->prix * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }
    
        return view('commande.commande', compact('total', 'totalQuantity'));
    }

    public function validationCommande(Request $request)
{
    $request->validate([
        'nom_complet' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'instructions' => 'nullable|string|max:255',
    ]);
    
    $utilisateur_id = Auth::id();
    $cart = session()->get('cart', []);
    $total = 0;

    // Vérifiez le contenu du panier
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    foreach ($cart as $item) {
        // Vérifiez les valeurs de prix et de quantité
        if (!isset($item['product']->prix) || !isset($item['quantity'])) {
            return redirect()->back()->with('error', 'Une erreur est survenue avec un produit dans votre panier.');
        }
        $total += $item['product']->prix * $item['quantity'];
    }

    logger("Total avant enregistrement de la commande : $total");

    $commande = new Commande();
    $commande->utilisateur_id = $utilisateur_id;
    $commande->nom_client = $request->nom_complet;
    $commande->ville = $request->ville;
    $commande->adresse = $request->adresse;
    $commande->instructions_speciales = $request->instructions;
    $commande->total = $total;
    $commande->save();

    logger("ID de la commande nouvellement créée : $commande->id");

    foreach ($cart as $item) {
        $detailsCommande = new DetailsCommande();
        $detailsCommande->commande_id = $commande->id;
        $detailsCommande->produit_id = $item['product']->id;
        $detailsCommande->quantite = $item['quantity'];
        $detailsCommande->prix_unitaire = $item['product']->prix;
        $detailsCommande->save();
    }

    session()->forget('cart');

    return redirect()->route('payment', ['commandeId' => $commande->id]);
}
}