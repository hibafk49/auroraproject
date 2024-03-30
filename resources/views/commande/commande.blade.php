@extends('layouts.app')

@section('commande')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Confirmation de commande</h2>
                <form action="{{ route('validation.commande') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nom_complet" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville</label>
                        <select name="ville" id="ville" class="form-control">
                            <option value="">Sélectionnez une ville</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions spéciales</label>
                        <textarea class="form-control" id="instructions" name="instructions" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer la commande</button>
                </form>
            </div>
            <div class="col-md-4">
                <div class="summary">
                    <h5><b>Résumé</b></h5>
                    <hr>
                    <div class="row">
                        <div class="col">ARTICLES {{ $totalQuantity }}</div>
                        <div class="col text-right">{{ $total }} MAD</div>
                    </div>
                    <form>
                        <p>LIVRAISON</p>
                        <select class="form-select">
                            @php
                                $livraison = 30; // Prix de la livraison standard
                                $livraisonText = "Livraison Standard - $livraison.00 MAD"; // Texte par défaut
                                $totalAvecLivraison = $total; // Initialiser le total avec le prix des produits uniquement
                    
                                // Vérifier si le total est supérieur ou égal à 1499 pour la livraison gratuite
                                if ($total >= 1499) {
                                    $livraisonText = "Livraison gratuite"; // Mettre à jour le texte de la livraison
                                } else {
                                    $totalAvecLivraison += $livraison; // Ajouter le prix de la livraison au total
                                }
                            @endphp
                            <option selected>{{ $livraisonText }}</option>
                        </select>
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">PRIX TOTAL</div>
                        <div class="col text-right" id="total">
                            {{ $totalAvecLivraison }} MAD
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
     /* Overall styling */
.card {
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 20px;
  background-color: #fff;
}

/* Title section */
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

/* Cart items section */
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

/* Summary section */
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
  background-color: #ff6666; /* Light pink */
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 12px 24px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

.summary .btn:hover {
  background-color: #ff3333; /* Darker pink on hover */
}

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const villeSelect = document.getElementById('ville');

            // Charger les villes à partir du fichier JSON
            fetch('/ville.json')
                .then(response => response.json())
                .then(data => {
                    data.forEach(ville => {
                        const option = document.createElement('option');
                        option.value = ville.id;
                        option.textContent = ville.ville;
                        villeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des villes :', error));

            // Gérer le changement de sélection de la ville
            villeSelect.addEventListener('change', () => {
                const selectedVilleId = villeSelect.value;
                // Vous pouvez ajouter ici la logique pour gérer la sélection de la ville
            });
        });
    </script>
@endsection
