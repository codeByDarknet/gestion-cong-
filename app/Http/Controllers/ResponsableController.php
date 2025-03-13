<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Role;
use App\Models\Service;
use App\Models\TypeDemande;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ResponsableController extends Controller
{
    //
 

    public function dashboard()
    {
        // Récupérer le service du responsable connecté
        $service = Auth::user()->service;

        // Récupérer toutes les demandes des employés du service sauf celles qui sont planifiées
        // et qui n'ont pas de commentaire de modification
        $demandes = Demande::whereHas('user', function ($query) use ($service) {
            $query->where('role_id', '!=', 2); // Exclure les autres responsables
            $query->where('service_id', $service->id);
            $query->where('statut', '!=', 'Plannifiée');
        })->whereNull('commentaire_modification')
          ->get();

        // Récupérer tous les employés du service
        $employes = User::where('service_id', $service->id)
            ->whereHas('role', function ($query) {
                $query->where('nom', 'employé'); // Filtrer les employés
            })
            ->get();

        // Récupérer tous les types de demandes
        $types = TypeDemande::all();

        return view('responsable.dashboard', compact('demandes', 'employes', 'service', 'types'));
    }




    public function demandesPersonnel()
    {

        //  retourner aussi la liste des demandes du  responsable en question

        $mes_demandes = Demande::where('user_id', auth()->user()->id)->get();
        $types = TypeDemande::all();

        return view('responsable.demandes_personnel', compact('mes_demandes', 'types'));
    }

    public function demandesEmployes()
    {


        // la demande du responsable ne doit pas etre afficher
        $demandes = Demande::whereHas('user', function ($query) {
            $query->where('role_id', '!=', 2);
            $query->where('service_id', Auth::user()->service_id);
            $query->where('statut', '!=', 'Plannifiée');
        })->whereNull('commentaire_modification')
             ->get();


        return view('responsable.demandes_employes', compact('demandes'));
    }


    public function historiquesDeMesDemandes(){

        $user = Auth::user();

        // Filtrer les demandes appartenant à cet utilisateur avec les statuts "Acceptée" ou "Rejetée"
        $demandes = Demande::where('user_id', $user->id)
            ->whereIn('statut', ['Acceptée', 'Rejetée'])
            ->get();
    $types = TypeDemande::all();

        return view('responsable.demandes_historique', compact('demandes', 'types'));
    }



    public function listeEmployes()
    {
        $service = Auth::user()->service; // Récupère le service de l'utilisateur connecté
        $roles = Role::all(); // Récupère tous les rôles

        // Récupérer uniquement les employés qui ont le même service que l'utilisateur connecté
        $employes = User::where('service_id', $service->id)
                        ->whereHas('role', function ($query) {
                            $query->where('nom', 'employé'); // Filtrer les employés
                        })
                        ->get();

        return view('responsable.liste_employes', compact('employes', 'service', 'roles'));
    }


}
