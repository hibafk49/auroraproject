@extends('layouts.app')

@section('showallcollection')
<div class="container">
    <h1>Toutes les collections</h1>

    @foreach($collections as $collection)
    <div class="card mb-3">
        <div class="card-header">
            {{ $collection->nom }}
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($collection->produits as $produit)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($produit->image_path) }}" class="card-img-top" alt="{{ $produit->nom }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">{{ $produit->description }}</p>
                            <p class="card-text">Prix: {{ $produit->prix }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
