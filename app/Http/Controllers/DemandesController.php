<?php

namespace App\Http\Controllers;

use App\Mail\SoumissionsMail;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Mail\StatutDemandeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DemandesController extends Controller
{
    //

    public function index()
    {
        return view('demandes.index');
    }

    public function touteslesdemandes()
    {
        return view('');
    }

    public function accepter($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'Acceptée';
        $demande->save();

        if ($demande->user && $demande->user->email) {
            Mail::to($demande->user->email)->send(new StatutDemandeMail($demande));
        }

        return redirect()->back()->with('success', 'Vous aviez accepté la Demande avec succès.');
    }

    public function rejeter($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'Rejetée';
        $demande->save();

        if ($demande->user && $demande->user->email) {
            Mail::to($demande->user->email)->send(new StatutDemandeMail($demande));
        }

        return redirect()->back()->with('success', 'Vous aviez rejeter la Demande  avec succès.');
    }


    public function planifierDemande(Request $request)
    {
        //


        $request->validate([
            'type_demande_id' => 'required|exists:type_demandes,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
            'piece_jointe' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        // Gestion de l'upload du fichier
        $piece_jointe = null;
        if ($request->hasFile('piece_jointe')) {
            $piece_jointe = $request->file('piece_jointe')->store('pieces_jointes', 'public');
        }

        // Création de la demande
        $demande = Demande::create([
            'user_id' => Auth::id(), // ID de l'utilisateur connecté
            'type_demande_id' => $request->type_demande_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'piece_jointe' => $piece_jointe,
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Votre demande a été planifiée avec succès.');
    }


    public function demanderModification(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'commentaire_modification' => 'required|string|max:1000',
            'modication_urgente' => 'sometimes|boolean',
        ], [
            'commentaire_modification.required' => 'Veuillez préciser la raison de votre demande de modification.',
            'commentaire_modification.max' => 'Le commentaire ne doit pas dépasser 1000 caractères.',
        ]);

        // Récupération de la demande
        $demande = Demande::findOrFail($id);

        // Vérification des autorisations (exemple: l'utilisateur est propriétaire de la demande)
        if ($demande->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette demande.');
        }


        // Mise à jour de la demande
        $demande->commentaire_modification = $validated['commentaire_modification'];
        $demande->modication_urgente = $request->has('modication_urgente');
        $demande->statut = 'Demandée'; // Mise à jour du statut
        $demande->save();



        return redirect()->route('employe.accueil')->with('success', 'Votre demande de modification a été envoyée avec succès.');
    }


    public function demanderRelancement(Request $request, $id)
    {
        // Récupération de la demande
        $demande = Demande::findOrFail($id);

        // Vérification des autorisations
        if ($demande->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à relancer cette demande.');
        }

        // Vérification du statut (on ne peut relancer que les demandes en attente)
        if ($demande->statut !== 'Plannifiée' && $demande->statut !== 'Demandée') {
            return redirect()->back()->with('error', 'Seules les demandes en attente peuvent être relancées.');
        }

        // Mise à jour de la demande
        $demande->relancer = true;

        $grh = User::where('role_id', 3)->first();

        Mail::to($grh->email)->send(new SoumissionsMail($demande));

        $demande->updated_at = now(); // Mettre à jour la date pour indiquer l'action récente
        $demande->save();



        return redirect()->route('employe.accueil')->with('success', 'Votre demande a été relancée avec succès.');
    }


    public function modifierDemande(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);

        $request->validate([
            'type_demande_id' => 'required|exists:type_demandes,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
            'piece_jointe' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        // Gestion de l'upload du fichier
        $piece_jointe = $demande->piece_jointe;
        if ($request->hasFile('piece_jointe')) {
            $piece_jointe = $request->file('piece_jointe')->store('pieces_jointes', 'public');
        }

        // Mise à jour de la demande
        $demande->update([
            'type_demande_id' => $request->type_demande_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'piece_jointe' => $piece_jointe,
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Votre demande a été modifiée avec succès.');
    }



    public function traiterModification(Request $request, $id) {
        $demande = Demande::findOrFail($id);


        if ($request->input('action') === 'accepter') {
            // Valider les données
            $validated = $request->validate([
                'type_demande' => 'required|exists:type_demandes,id',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
            ]);

            // Mettre à jour la demande
            $demande->update([
                'type_demande_id' => $validated['type_demande'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'commentaire_modification' => null,
            ]);

            return redirect()->route('demandes.toutes')->with('success', 'La demande a été modifiée avec succès.');
        } elseif ($request->input('action') === 'rejeter') {
            // Rejeter la demande
            $demande->update([
                'commentaire_modification' => null,
            ]);

            return redirect()->route('demandes.toutes')->with('success', 'vous aviez rejetter la mofication.');
        }


        return redirect()->back()->with('error', 'Action non valide.');

    } // traiterModification

    public function soumettreDemande($id)
    {
        $demande = Demande::findOrFail($id);

        // Vérifier si l'utilisateur authentifié a un service
        $user = Auth::user();
        if (!$user->service_id) {
            return redirect()->back()->with('error', 'Votre compte n\'est associé à aucun service.');
        }

        // Déterminer le destinataire de la demande
        $destinataire = null;
        $envoyerAuGRH = false;

        // Si l'utilisateur est un chef de service (responsable)
        if ($user->role_id == 2) { // responsable
            // Envoyer directement au GRH
            $destinataire = User::where('role_id', 3)->first(); // GRH
            $envoyerAuGRH = true;
        } else {
            // L'utilisateur est un employé, chercher son chef de service
            $chef = User::where('service_id', $user->service_id)
                ->where('role_id', 2) // responsable
                ->first();

            // Si pas de chef dans le service, envoyer au GRH
            if (!$chef) {
                $destinataire = User::where('role_id', 3)->first(); // GRH
                $envoyerAuGRH = true;
            } else {
                $destinataire = $chef;
            }
        }

        // Vérifier si un destinataire a été trouvé
        if (!$destinataire) {
            return redirect()->back()->with('error', 'Impossible de trouver un destinataire pour votre demande.');
        }

        // Changer le statut de la demande
        $demande->statut = 'Demandée';

        // Si la demande est envoyée au GRH, désactiver la possibilité de relance
        if ($envoyerAuGRH) {
            $demande->relancer = false;
        } else {
            // Conserver la valeur existante ou la réinitialiser si nécessaire
            $demande->relancer = false; // Initialisation à false, pourra être modifiée plus tard
        }

        $demande->save();

        // Envoyer l'email au destinataire
        Mail::to($destinataire->email)->send(new SoumissionsMail($demande));

        // Message de succès différent selon le destinataire
        if ($envoyerAuGRH) {
            return redirect()->back()->with('success', 'Votre demande a été soumise directement au GRH. Vous ne pourrez pas la relancer.');
        } else {
            return redirect()->back()->with('success', 'Votre demande a été soumise à votre chef de service.');
        }
    }


    //  supression de demande
    public function supprimerDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect()->back()->with('success', 'Votre demande a été supprimée avec succès.');
    }
}
