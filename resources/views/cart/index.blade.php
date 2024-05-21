@extends('layouts.app')

@section('panier')
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Votre Panier</b></h4></div>
                    <div class="col align-self-center text-right text-muted">{{ $totalQuantity }} articles</div>
                </div>
            </div>    
            @if(count($cart) > 0)
                @foreach($cart as $id => $item)
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="{{ asset($item['product']->image_path) }}"></div>
                            <div class="col">
                                <div class="row text-muted">{{ $item['quantity'] }} x {{ $item['product']->nom }}</div>
                                @if(isset($item['couleur_id']))
                                Couleur: {{ \App\Models\Couleur::find($item['couleur_id'])->nom }}
                            @endif
                            
                            </div>
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="Quantité">
                                    <button type="button" class="btn btn-outline-dark decrease-quantity" data-id="{{ $id }}">-</button>
                                    <button type="button" class="btn btn-outline-dark quantity-display">{{ $item['quantity'] }}</button>
                                    <button type="button" class="btn btn-outline-dark increase-quantity" data-id="{{ $id }}">+</button>
                                </div>
                            </div>
                            
                            <div class="col">{{ $item['product']->prix * $item['quantity'] }} MAD  </div><div class="col">
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
                <form action="{{ route('cart.clear') }}" method="post"> 
                    @csrf
                    <button type="submit" class="btn btn-danger">Vider le Panier</button>
                </form>
            @else
                <p>Votre panier est vide.</p>
            @endif
            <div class="back-to-shop"><a href=""{{route('welcome')}}>&leftarrow;</a><span class="text-muted">Retour à la boutique</span></div>
        </div>
        
    <div> 
        <a href="{{ route('confirmation.commande') }}" class="btn btn-primary">Confirmation de commande</a></div>
    </div>
    </div> 




<style>
.card {
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 20px;
  background-color: #fff;
}

.title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ddd;
  padding-bottom: 10px;
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

.cart .img-fluid {
  width: 100px;
  height: auto;
  object-fit: cover;
  border-radius: 6px;
  margin-right: 20px;
}

.cart .text-muted {
  color: #777;
}

.cart .close {
  color: #999;
  font-size: 18px;
  cursor: pointer;
}

.cart .close:hover {
  color: #555;
}

.summary {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 20px;
  background-color: #f9f9f9;
}

.summary h5 {
  margin: 0;
  font-weight: bold;
  color: #333;
}

.summary select,
.summary input[type="text"] {
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  width: 100%;
  margin-bottom: 10px;
  background-color: #fff;
  color: #555;
}

.summary .btn {
  background-color: #ff6666;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 12px 24px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

.summary .btn:hover {
  background-color: #ff3333; 
}

    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.increase-quantity').click(function() {
            var productId = $(this).data('id'); 
            updateQuantity(productId, 'increase'); 
        });

        $('.decrease-quantity').click(function() {
            var productId = $(this).data('id'); 
            updateQuantity(productId, 'decrease'); 
        });

        function updateQuantity(productId, action) {
            $.ajax({
                type: 'POST', 
                url: '/cart/update-quantity/' + productId, 
                data: {
                    action: action 
                },
                success: function(response) {
                    $('.quantity-display').text(response.quantity);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>

@endsection




    