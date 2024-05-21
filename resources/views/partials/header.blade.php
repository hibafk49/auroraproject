<header>
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="{{route('welcome')}}">
            <img src="{{ asset('logo1.png') }}" alt="Aurora" width="120">
        </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('welcome')}}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Collection
                    </a>
                    <ul class="submenu dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a id="text-light-blue" class="dropdown-item" href="{{ route('collection.produits', ['collection' => 'Tous les collections']) }}">Tous les collections</a></li>
        <li><a class="dropdown-item" href="{{ route('collection.produits', ['collection' => '1']) }}">Bliss Collection</a></li>
        <li><a class="dropdown-item" href="{{ route('collection.produits', ['collection' => '2']) }}">Serenity Collection</a></li>
        <li><a class="dropdown-item" href="{{ route('collection.produits', ['collection' => '3']) }}">Elegance Collection</a></li>
        <li><a class="dropdown-item" href="{{ route('collection.produits', ['collection' => '4']) }}">Oasis Collection</a></li>

                    </ul>
                    
                    
                </li>
                

                <li class="nav-item">
                    <a id="promo" class="nav-link" href="{{route('promotions.index')}}">PROMO</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">Visitez-nous</a>
                </li>
                <li class="nav-item">
                    <a id="icon1" class="nav-link" href="{{route('cart.index')}}">
    <i class="fas fa-shopping-cart"></i>
</a>

                </li>
                
                <li class="nav-item">
                    <a id="icon2" class="nav-link" href="/login"><i class="fas fa-user"></i></a>
                </li>
               
                @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="#"><i class="fa-solid fa-id-badge"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> Commandes</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                @csrf
                                <center>
                                    <button type="submit" id="logout">
                                        <i class="fa fa-sign-out"></i> Déconnexion
                                    </button>
                                </center>
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

            </ul>
        </div>
    </nav>
</header>
