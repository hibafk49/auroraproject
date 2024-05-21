<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\DetailsCommande;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;

class ConfirmationCommandeController extends Controller
{
    public function confirmationCommande()
{
    $cart = session()->get('cart', []);
    $total = 0;
    $totalQuantity = 0;
    $products = []; 

    foreach ($cart as $id => $item) {
        $product = Produit::findOrFail($id);
        $products[] = [
            'product' => $product,
            'quantity' => $item['quantity'],
            'total_price' => $product->prix * $item['quantity']
        ];
        $total += $products[count($products) - 1]['total_price'];
        $totalQuantity += $item['quantity'];
        $livraison = 30;
        $total = $total + $livraison;
    
        if ($total >= 1499) {
            $livraison = 0;
            $total = $total + $livraison;
        }
    
    }

    return view('commande.commande', compact('total', 'totalQuantity', 'products'));
}


public function validationCommande(Request $request)
{
    $request->validate([
        'nom_complet' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'telephone_client' => 'required|string|max:20', 
        'adresse' => 'required|string|max:255',
        'instructions' => 'nullable|string|max:255',
    ]);

    $utilisateur_id = Auth::id();
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    $total = collect($cart)->sum(function ($item ) {
        
        return $item['product']->prix * $item['quantity'] + 30;
    });
   
    logger("Total avant enregistrement de la commande : $total");

    $commande = new Commande();
    $commande->utilisateur_id = $utilisateur_id;
    $commande->nom_client = $request->nom_complet;
    $commande->telephone_client = $request->telephone_client; 
    $commande->ville = $request->ville;
    $commande->adresse = $request->adresse;
    $commande->instructions_speciales = $request->instructions;
    $commande->total = $total;
    $commande->save();

    logger("ID de la commande nouvellement créée : $commande->id");

    foreach ($cart as $id => $item) {
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