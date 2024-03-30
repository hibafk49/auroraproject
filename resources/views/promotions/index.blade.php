<!-- index.blade.php -->

@extends('layouts.app')

@section('promo')
<h1>Promotions</h1>

<div class="row">
    @foreach ($promotions as $promotion)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset($promotion->produit->image_path) }}" class="card-img-top" alt="{{ $promotion->produit->nom }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $promotion->produit->nom }}</h5>
                    <p class="card-text">{{ $promotion->produit->description }}</p>
                    <p class="card-text">Prix: {{ $promotion->produit->prix }} €</p>
                    <p class="card-text">Réduction: {{ $promotion->pourcentage_reduction }}%</p>
                    <p class="card-text">Prix réduit: {{ calculerPrixReduit($promotion->produit->prix, $promotion->pourcentage_reduction) }} €</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@php
function calculerPrixReduit($prixOriginal, $pourcentageReduction)
{
    return $prixOriginal - ($prixOriginal * ($pourcentageReduction / 100));
}
@endphp
