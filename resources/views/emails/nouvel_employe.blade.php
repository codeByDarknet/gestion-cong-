<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Compte sur CongeFacile</title>
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
            margin: 20px auto;
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
        }

        .container p {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Votre compte a été créé avec succès</h1>
        <p>Bonjour <strong>{{ $employe->name }} {{ $employe->prenom }}</strong>,</p>
        <p>Votre compte a été créé le <strong>{{ \Carbon\Carbon::parse($employe->created_at)->format('d/m/Y') }}</strong>.
            Vous occupez le poste de <strong>{{ $employe->fonction }}</strong> dans le service <strong>{{ $employe->service->nom }}</strong>.</p>

        <p>Vos identifiants de connexion sont :</p>
        <ul>
            <li><strong>Email :</strong> {{ $employe->email }}</li>
            <li><strong>Mot de passe :</strong> {{ $password }}</li>
        </ul>

        <p class="highlight">Veuillez ne partager ces informations avec personne.</p>

        <p class="footer">Cordialement,</p>
        <p class="footer signature">L'équipe RH / CongeFacile</p>
    </div>

</body>

</html>
