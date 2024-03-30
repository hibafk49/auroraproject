<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Session;

class PanierController extends Controller
{public function __construct()
    {
        $this->middleware('auth'); // Appliquer le middleware 'auth' à toutes les méthodes du contrôleur
    }
    public function index()
{
    $cart = Session::has('cart') ? Session::get('cart') : [];
    $totalQuantity = 0;
    $total = 0;

    foreach ($cart as $item) {
        $totalQuantity += $item['quantity'];
        // Assurez-vous que le prix est correctement récupéré
        $total += $item['product']->prix * $item['quantity'];
    }

    return view('cart.index', compact('cart', 'totalQuantity', 'total'));
}


    
public function addToCart(Request $request, $id)
{
    $product = Produit::findOrFail($id);
    $couleurId = $request->input('couleur');
    $quantity = $request->input('quantity', 1);

    $cart = Session::has('cart') ? Session::get('cart') : [];

    if (array_key_exists($id, $cart)) {
        $cart[$id]['quantity'] += $quantity;
        // Mettre à jour l'ID de la couleur si nécessaire
        $cart[$id]['couleur_id'] = $couleurId;
    } else {
        $cart[$id] = [
            'product' => $product,
            'quantity' => $quantity,
            'couleur_id' => $couleurId,
        ];
    }

    Session::put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
}




    
public function updateCartItem(Request $request, $id)
{
    $action = $request->input('action');
    $cart = Session::has('cart') ? Session::get('cart') : [];

    if (array_key_exists($id, $cart)) {
        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }
    }

    Session::put('cart', $cart);

    return response()->json(['quantity' => $cart[$id]['quantity']]);
}


    public function removeCartItem($id)
    {
        $cart = Session::has('cart') ? Session::get('cart') : [];

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart item removed successfully!');
    }

    public function clearCart()
    {
        Session::forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
