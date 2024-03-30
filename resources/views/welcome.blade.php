@extends('layouts.app')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-75 h-30 mx-auto img-fluid" src="slide1.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Nouveau arrivage</h5>
                <p></p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-75 h-30 mx-auto img-fluid" src="slide2.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Nouveau arrivage</h5>
                <p></p>
            </div>
        </div>
        
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="container">
    <h2 class="mt-5 mb-3">Tous les Produits</h2>

    <div class="row">
        @foreach($produits as $produit)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $produit->image_path }}" class="card-img-top" alt="{{ $produit->nom }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $produit->nom }}</h5>
                    <p class="card-text">{{ $produit->description }}</p>
                    <a href="{{ route('produits.show', ['id' => $produit->id]) }}" class="btn btn-primary">Voir Détails</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="container">
    <div class="header">
        <h1>Welcome to Aurora</h1>
        <p>Your ultimate destination for trendy handbags</p>
        <a href="#" class="cta-button">Shop Now</a>
    </div>
    <div class="feature-list">
        <div class="feature">
            <h2>Stylish Designs</h2>
            <p>Discover our wide range of handbags featuring the latest designs and trends.</p>
        </div>
        <div class="feature">
            <h2>Quality Materials</h2>
            <p>Our handbags are crafted from premium materials to ensure durability and style.</p>
        </div>
        <div class="feature">
            <h2>Express Shipping</h2>
            <p>Get your favorite handbag delivered to your doorstep in no time with our express shipping options.</p>
        </div>
    </div>
</div>
@endsection
