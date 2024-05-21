@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Paiement</div>
                    <div class="card-body">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=AZCCsjpUBW8Qen9HeSi-CXlmE_NEILdIhtwSqfUjJUSLsx9c2-uK6JGnr_-Onph13zpHcuALZnqC5FXT"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                var totalAmount = {{ $total }};
    
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalAmount.toFixed(2), 
                            currency_code: 'USD' 
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    return fetch("{{ route('process.payment') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            orderID: {{ $commande->id }}, 
                            payerID: details.payer.payer_id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Une erreur s\'est produite lors du traitement du paiement.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('confirmation.success') }}";
                        } else {
                            throw new Error('Erreur lors du traitement du paiement.');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors du traitement du paiement :', error);
                        alert('Une erreur s\'est produite lors du traitement du paiement.');
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
