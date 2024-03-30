<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Promotion;


class ProduitController extends Controller
{
    public function show($id)
    {
        $produit = Produit::with('couleurs')->findOrFail($id);
        return view('produits.show', compact('produit'));
    }
    
    public function index(Request $request, $collection)
{
    if ($collection === 'all') {
        $produits = Produit::all();
        $collectionName = 'Tous les produits';
    } else {
        $produits = Produit::where('collection_id', $collection)->get();
        $collectionName = Categorie::findOrFail($collection)->nom;
    }
    return view('produits.collection', ['produits' => $produits, 'collectionName' => $collectionName]);
}
public function promotions()
{
    $produitsPromo = Produit::whereHas('promotion', function ($query) {
        $query->where('date_debut', '<=', now())
              ->where('date_fin', '>=', now());
    })->get();

    return view('promotions.index', ['produitsPromo' => $produitsPromo]);
}


}
