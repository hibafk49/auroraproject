<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora</title>
    <script src="https://kit.fontawesome.com/9699792f44.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
    <div class="loader-container" id="loader">
        <div class="loader-container" style="--loader-dot-color: black; --loader-dot-size: 50px; --loader-dot-spacing: 25px;">
        <div class="loader-dots">
           <div class="loader-dot moving-dot"></div>
           <div class="loader-dot fixed-dot"></div>
           <div class="loader-dot fixed-dot"></div>
           <div class="loader-dot fixed-dot"></div>
        </div>
     </div>
      </div>
      
      <div class="container" id="id">
        <div class="horizontal-scrolling-items">
        
        <div class="horizontal-scrolling-items__item">
        LIVRAISON GRATUITE PARTOUT AU MAROC OFFERTE À PARTIR DE 1499 DH D'ACHATS&nbsp
        </div>
        
        <div class="horizontal-scrolling-items__item">
            LIVRAISON GRATUITE PARTOUT AU MAROC OFFERTE À PARTIR DE 1499 DH D'ACHATS&nbsp
        </div>
        <div class="horizontal-scrolling-items__item">
            LIVRAISON GRATUITE PARTOUT AU MAROC OFFERTE À PARTIR DE 1499 DH D'ACHATS&nbsp
        </div>
        </div>
          
        </div>
     
   @include('partials.header')

   <script>document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loader").classList.add("visible");
});

window.addEventListener("load", function() {
    setTimeout(function() {
        document.getElementById("loader").classList.remove("visible");
    }, 3000); 
});


</script>
        @yield('content')
        @yield('show')
        @yield('panier')
        @yield('privacy')
        @yield('terms')
        @yield('showcollection')
        @yield('promo')
        @yield('commande')
    @include('partials.footer')
  
   
</body>
</html>
