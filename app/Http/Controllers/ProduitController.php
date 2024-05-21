<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
class ProduitController extends Controller
{
    public function show($id)
    {
        $produit = Produit::with('couleurs')->findOrFail($id);
        return view('produits.show', compact('produit'));
    }
    public function index(Request $request, $collection)
{
    if ($collection === 'Tous les collections') {
            $collections = Categorie::all();
            $collectionsAvecProduits = [];
            foreach ($collections as $collection) {
                $produits = $collection->produits()->get(); 
                $collectionsAvecProduits[] = [
                    'collection' => $collection,
                    'produits' => $produits,
                ];
            }
            return view('produits.allcollections', ['collectionsAvecProduits' => $collectionsAvecProduits]);
        
        
    } else {
        $produits = Produit::where('collection_id', $collection)->get();
        $collectionName = Categorie::findOrFail($collection)->nom;
        return view('produits.collection', ['produits' => $produits, 'collectionName' => $collectionName]);

    }
}

}
