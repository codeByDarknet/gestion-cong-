<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Demande à Examiner</title>
</head>
<body>
    <h2>Bonjour,</h2>

    <p>Une nouvelle demande a été soumise par <strong>{{ $employe->nom }} {{ $employe->prenom }}</strong>.</p>

    <p><strong>Type de demande :</strong> {{ $demande->typeDemande->libelle }}</p>
    <p><strong>Date de début :</strong> {{\Carbon\Carbon::parse($demande->date_debut)->translatedFormat('d F Y') }} </p>
    <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($demande->date_fin)->translatedFormat('d F Y') }}</p>
    <p><strong>Motif :</strong> {{ $demande->motif }}</p>

    @if($demande->piece_jointe)
        <p><strong>Pièce jointe :</strong> <a href="{{ asset('storage/' . $demande->piece_jointe) }}" target="_blank">Voir la pièce jointe</a></p>
    @endif

    <p>Veuillez examiner la demande et choisir une action :</p>

    <a href="{{ $acceptUrl }}" style="padding: 10px 15px; background: green; color: white; text-decoration: none; border-radius: 5px;">✅ Accepter</a>
    <a href="{{ $rejectUrl }}" style="padding: 10px 15px; background: red; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">❌ Rejeter</a>

    <p>Merci.</p>
</body>
</html>
