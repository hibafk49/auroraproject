@extends('layouts.app')

@section('panier')
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <h4><b>Votre Panier</b></h4>
                <div class="col align-self-center text-right text-muted">{{ $totalQuantity }} articles</div>
            </div>
            @if(count($cart) > 0)
                @foreach($cart as $id => $item)
                    <div class="row border-top border-bottom py-3">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid product-image" src="{{ asset($item['product']->image_path) }}"></div>
                            <div class="col">
                                <div class="row text-muted">{{ $item['quantity'] }} x {{ $item['product']->nom }}</div>
                                @if(isset($item['couleur_id']))
                                    <div class="row mt-1">
                                        <span class="product-color">{{ \App\Models\Couleur::find($item['couleur_id'])->nom }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="Quantité">
                                    <button type="button" class="btn btn-outline-dark decrease-quantity" data-id="{{ $id }}">-</button>
                                    <button type="button" class="btn btn-outline-dark quantity-display">{{ $item['quantity'] }}</button>
                                    <button type="button" class="btn btn-outline-dark increase-quantity" data-id="{{ $id }}">+</button>
                                </div>
                            </div>
                            <div class="col font-weight-bold">{{ number_format($item['product']->prix * $item['quantity'], 2) }} MAD</div>
                            <div class="col text-right">
                                <form action="{{ route('cart.remove', ['id' => $id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" style="background-color: transparent; border: none;">
                                        <img src="{{ asset('icons8-delete-button.gif') }}" alt="Supprimer" width="16" height="16">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <form action="{{ route('cart.clear') }}" method="post"> 
                        @csrf
                        <button type="submit" class="btn btn-danger">Vider le Panier</button>
                    </form>
                    <a href="{{ route('confirmation.commande') }}" class="btn btn-primary">Confirmation de commande</a>
                </div>
            @else
                <p class="mt-4 text-center">Votre panier est vide.</p>
            @endif
            <div class="back-to-shop mt-3">
                <a href="{{ route('welcome') }}" class="text-decoration-none">&leftarrow; Retour à la boutique</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary">
                <h2>Résumé de la commande</h2>
                <hr>
                <div class="row">
                    <div class="col">ARTICLES {{ $totalQuantity }}</div>
                    <div class="col text-right font-weight-bold">{{ number_format($total, 2) }} MAD</div>
                </div>
                <form>
                    <p class="mt-3">LIVRAISON</p>
                    <select class="form-select">
                        @php
                            $livraison = 30; 
                            $livraisonText = "Livraison Standard - $livraison.00 MAD"; 
                            $totalAvecLivraison = $total; 

                            if ($total >= 1499) {
                                $livraisonText = "Livraison gratuite"; 
                            } else {
                                $totalAvecLivraison += $livraison; 
                            }
                        @endphp
                        <option selected>{{ $livraisonText }}</option>
                    </select>
                </form>
                <div class="row mt-3" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">PRIX TOTAL</div>
                    <div class="col text-right font-weight-bold" id="total">
                        {{ number_format($totalAvecLivraison, 2) }} MAD
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  
.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 30px;
    background-color: #fff;
}

.title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.title h4 {
    margin: 0;
    font-weight: bold;
    color: #333;
}

.cart .row {
    margin-bottom: 20px;
}

.cart .main {
    display: flex;
    align-items: center;
}

.cart .product-image {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 6px;
    transition: transform 0.3s;
}

.cart .product-image:hover {
    transform: scale(1.05);
}

.cart .text-muted {
    color: #777;
}

.cart .btn-group .btn {
    padding: 6px 10px;
    font-size: 16px;
}

.summary {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    text-align: center;
}

.summary h2 {
    margin-bottom: 20px;
    color: #333;
}

.summary .btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 12px 24px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.summary .btn:hover {
    background-color: #0056b3; 
}

.product-color {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 15px;
    background-color: #f0f0f0;
    color: #333;
    font-size: 14px;
}

.back-to-shop a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.2s;
}

.back-to-shop a:hover {
    color: #0056b3;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.increase-quantity, .decrease-quantity').click(function() {
        var productId = $(this).data('id');
        var action = $(this).hasClass('increase-quantity') ? 'increase' : 'decrease';
        
        $.ajax({
            type: 'POST',
            url: '/cart/update-quantity/' + productId,
            data: {
                _token: '{{ csrf_token() }}',
                action: action
            },
            success: function(response) {
                // Update the quantity display
                var quantityDisplay = $('.quantity-display[data-id="' + productId + '"]');
                var newQuantity = response.newQuantity;
                quantityDisplay.text(newQuantity);
                
                // Update the total price for the item
                var priceDisplay = $('.price-display[data-id="' + productId + '"]');
                var newPrice = response.newPrice;
                priceDisplay.text(newPrice + ' MAD');
                
                // Update the cart summary
                $('#total').text(response.newTotal + ' MAD');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
