<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut de votre demande</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #2d2d2d;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .status-acepted {
            font-weight: bold;
            color: #4CAF50;
            /* couleur verte pour le statut */
        }

        .status-refused {
            font-weight: bold;
            color: #F44336;
            /* couleur rouge pour le statut */
        }

        .footer {
            font-size: 14px;
            text-align: center;
            color: #777;
            margin-top: 20px;
        }

        .signature {
            font-style: italic;
            color: #444;
        }

        .highlight {
            color: #FF5722;
            /* couleur pour accentuer certains éléments */
        }

        .container p {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Statut de votre demande</h1>
        <p>Bonjour Mr <strong>{{ $demande->user->name }} {{ $demande->user->prenom }}</strong>,
            {{ $demande->user->fonction }} du service {{ $demande->user->service->nom }}.</p>

        <p>Le statut de votre demande de <strong>{{ $demande->typeDemande->libelle }}</strong> (prévu pour le
            <strong>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</strong> au
            <strong>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</strong>) a été mis à jour.
        </p>

        <p><strong>Nouveau statut :</strong> <span class="status-{{ $demande->statut === 'Acceptée' ? 'acepted' : 'refused' }}">{{ $demande->statut }}</span></p>

        <p>Merci de votre patience.</p>

        <p class="footer">Cordialement,</p>
        <p class="footer signature">L'équipe RH / Responsable de Services</p>
    </div>

</body>

</html>
