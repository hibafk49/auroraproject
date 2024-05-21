@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('Animation2.gif') }}" alt="Confirmation Animation" class="img-fluid mb-3" >
                    <h2 class="card-title font-weight-bold">Votre commande a été confirmée avec succès!</h2>
                    <p class="card-text">Merci pour votre achat.</p>
                    <a href="{{ route('welcome') }}" class="text-decoration-none">&leftarrow; Retour à la boutique</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
