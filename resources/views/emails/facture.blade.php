<!DOCTYPE html>
<html>
<head>
    <title>Votre Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 10px;
            color: #4CAF50;
        }
        .content {
            margin: 20px 0;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .content ul li:last-child {
            border-bottom: none;
        }
        .footer {
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Votre Facture</h1>
            <h2>Merci pour votre commande</h2>
        </div>
        <div class="content">
            <ul>
                <li><strong>ID de la facture:</strong> {{ $facture->id }}</li>
                <li><strong>Montant total:</strong> {{ number_format($facture->montant_total, 2) }} MAD</li>
                <li><strong>Date d'émission:</strong> {{ $facture->date_emission }}</li>
            </ul>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Aurora . Tous droits réservés.
        </div>
    </div>
</body>
</html>
