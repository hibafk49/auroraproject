@extends('layouts.app')

@section('promo')
<div class="container mt-5">
    <h1>Promo</h1>
    <div class="row">
        @if ($promotions->isEmpty())
            <center><p>Il n'y a pas de promotion pour le moment.</p></center>
        @else
            @foreach ($promotions as $promotion)
                @php
                    $currentDate = \Carbon\Carbon::now();
                    $isWithinDateRange = $currentDate->between($promotion->date_debut, $promotion->date_fin);
                @endphp

                @if ($isWithinDateRange)
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
                @endif
            @endforeach
        @endif
    </div>
</div>
@endsection

@php
    function calculerPrixReduit($prixOriginal, $pourcentageReduction)
    {
        return $prixOriginal - ($prixOriginal * ($pourcentageReduction / 100));
    }
@endphp
