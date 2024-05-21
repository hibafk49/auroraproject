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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
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
Route::get('/cart', [PanierController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [PanierController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [PanierController::class, 'updateCartItem'])->name('cart.update');
Route::post('/cart/update-quantity/{id}', [PanierController::class, 'updateQuantity']);
Route::post('/cart/remove/{id}', [PanierController::class, 'removeCartItem'])->name('cart.remove');
Route::post('/cart/clear', [PanierController::class, 'clearCart'])->name('cart.clear');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);
Route::get('/collections/{collection}/produits', [ProduitController::class, 'index'])->name('collection.produits');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/confirmation-commande', [ConfirmationCommandeController::class, 'confirmationCommande'])
    ->name('confirmation.commande');
Route::post('/validation-commande', [ConfirmationCommandeController::class, 'validationCommande'])
    ->name('validation.commande');
Route::get('/confirmation-success', function () {
    return view('confirmation.success');}) 
->name('confirmation.success');
Route::get('/payment/{commandeId}', [PaymentController::class, 'showPaymentPage'])->name('payment');
// Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
Route::get('/confirmation-success', function () {
    return view('confirmation.success');
})->name('confirmation.success');