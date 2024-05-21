@extends('layouts.app')

@section('showcollection')
<h1>{{ $collectionName }}</h1>
<ul class="list-group">
    @foreach($produits as $produit)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset($produit->image_path) }}" alt="{{ $produit->nom }}" class="img-thumbnail">
                </div>
                <div class="col-md-9">
                    <h3>{{ $produit->nom }}</h3>
                    <p>{{ $produit->description }}</p>
                    <p>Prix: {{ $produit->prix }}</p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
@endsection
