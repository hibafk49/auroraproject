@extends('layouts.app')

@section('commande')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm mb-4 rounded-lg">
              
                    <h2 class="mb-0 text-center">Confirmation de Commande</h2>
                
                <div class="card-body">
                    <form id="commandeForm" action="{{ route('validation.commande') }}" method="post">
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
                            <label for="telephone_client" class="form-label">Numéro de Téléphone</label>
                            <input type="tel" class="form-control" id="telephone_client" name="telephone_client" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>
                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instructions spéciales</label>
                            <textarea class="form-control" id="instructions" name="instructions" rows="3"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">Confirmer la Commande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-8">
          <div class="card shadow-sm mb-4 rounded-lg">
            <h2 class="mb-3 text-center">Résumé de Commande</h2> 
            <div class="card-body py-2"> 
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center" style="width: 80px;">
                                        <img src="{{ asset($product['product']->image_path) }}" alt="{{ $product['product']->nom }}" class="img-fluid rounded-circle" style="width: 40px;"> 
                                    </td>
                                    <td>{{ $product['quantity'] }} x {{ $product['product']->nom }}</td>
                                    <td class="text-end">{{ $product['total_price'] }} MAD</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between"> 
                    <div><strong>Total</strong></div> 
                    <div>{{ $total }} MAD</div>
                </div>
            </div>
        </div>
        
        </div>
    </div>
</div>
<style>
    .card {
        border-radius: 10px;
        border: 1px solid #ccc; 
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }

    .table img {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    @media (max-width: 576px) {
        .card-body, .table-responsive, .d-flex {
            text-align: center;
        }
        .d-flex {
            flex-direction: column;
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const villeSelect = document.getElementById('ville');

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
    });
</script>
@endsection
