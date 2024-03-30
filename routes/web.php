<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PromotionController ;
use App\Http\Controllers\ConfirmationCommandeController; 
use App\Http\Controllers\PaymentController;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index']);

Auth::routes();


// routes/web.php


Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy_policy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms_of_use');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');

Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::post('/add-to-cart/{produit}', [PanierController::class, 'addToCart'])->name('add-to-cart');

// Afficher le panier
Route::get('/cart', [PanierController::class, 'index'])->name('cart.index');

// Ajouter au panier
Route::post('/cart/add/{id}', [PanierController::class, 'addToCart'])->name('cart.add');

// Mettre à jour un article du panier
Route::post('/cart/update/{id}', [PanierController::class, 'updateCartItem'])->name('cart.update');

// Supprimer un article du panier
Route::post('/cart/remove/{id}', [PanierController::class, 'removeCartItem'])->name('cart.remove');

// Vider le panier
Route::post('/cart/clear', [PanierController::class, 'clearCart'])->name('cart.clear');


// Route pour afficher le formulaire de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour gérer la soumission du formulaire de connexion
Route::post('/login', [LoginController::class, 'login']);

// Route pour afficher le formulaire d'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route pour gérer la soumission du formulaire d'inscription
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/collections/{collection}/produits', [ProduitController::class, 'index'])->name('collection.produits');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

Route::get('/confirmation-commande', [ConfirmationCommandeController::class, 'confirmationCommande'])
    ->name('confirmation.commande');

// Route pour valider les informations du formulaire de confirmation de commande
Route::post('/validation-commande', [ConfirmationCommandeController::class, 'validationCommande'])
    ->name('validation.commande');

// Route pour afficher la page de confirmation de commande réussie
Route::get('/confirmation-success', function () {
    return view('confirmation.success');
})
->name('confirmation.success');
Route::get('/payment/{commandeId}', [PaymentController::class, 'showPaymentPage'])->name('payment');

Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
