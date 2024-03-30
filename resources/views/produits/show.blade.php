@extends('layouts.app')

@section('show')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img class="card-img-top mb-5 mb-md-0" src="{{ asset($produit->image_path) }}" alt="{{ $produit->nom }}" />
        </div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bolder">{{ $produit->nom }}</h1>
            <div class="fs-5 mb-5">
                <span>{{ $produit->prix }} MAD</span>
            </div>
            <p class="lead">{{ $produit->description }}</p>
            <div class="d-flex">
                <form action="{{ route('add-to-cart', ['produit' => $produit->id]) }}" method="post">
                    @csrf
                    <label for="couleurs">Choisir une couleur :</label>
    <select name="couleur" id="couleurs" class="form-control" onchange="updateSelectedCouleur(this.value)">
        @foreach($produit->couleurs as $couleur)
            <option value="{{ $couleur->id }}">{{ $couleur->nom }}</option>
        @endforeach
    </select><br>
    <input type="hidden" name="selected_couleur" id="selected_couleur" value="">
                    <div class="input-group">
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" onclick="decrementQuantity()">-</button>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" style="width: 60px;"/>
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" onclick="incrementQuantity()">+</button>
                    </div><br>
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="fa-solid fa-cart-plus"></i> Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
    
    function updateSelectedCouleur(couleurId) {
        document.getElementById('selected_couleur').value = couleurId;
    }

</script>
@endsection
