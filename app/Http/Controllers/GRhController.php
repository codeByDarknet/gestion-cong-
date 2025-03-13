<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\NouvelEmploye;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\TypeDemande;


class GRhController extends Controller
{
    //
    public function dashboard()
    {
        // dans le dashboard du GRH je vais tout tout lui fournir
        $demandes = Demande::all();
        $employes = User::where('role_id', '!=', 3)->get();
        $services = Service::all();
        $types = TypeDemande::all();
        return view('grh.dashboard', compact('demandes', 'employes', 'services', 'types'));
    }

    public function touteslesdemandes()
    {

        $demandes = Demande::all();
        $types = TypeDemande::all();

        foreach ($demandes as $demande) {
            if (Str::length($demande->commentaire_modification) > 0) {
                $demande->statut = 'À modifier';
            }
        }


        return view('grh.listes_demandes', compact('demandes', 'types'));
    }

    public function listeEmployes()
    {

        // retourne la liste des employés de tout les employés sauf le GRH
        $employes = User::where('role_id', '!=', 3)->get();
        $services = Service::all();
        $roles = Role::all();

        return view('grh.listes_employes', compact('employes', 'services', 'roles'));
    }

    public function AjouterEmploye(Request $request)

    {


        // Ajout d'un employé
        //generation de son mot de passe à 8 chiffres
        $password = Str::random(8);

        $request->merge([
            'matricule' => trim($request->matricule),
            'nom' => trim($request->nom),
            'prenom' => trim($request->prenom),
            'email' => trim($request->email),
            'telephone' => trim($request->telephone),
            'fonction' => trim($request->fonction),
        ]);

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|unique:users,matricule',
            'telephone' => 'required|string|unique:users,telephone',
            'fonction' => 'nullable|string|max:255',
            'date_de_prise_de_service' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'service_id' => 'required|exists:services,id',

        ]);

        $employe = User::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'fonction' => $request->fonction,
            'date_de_prise_de_service' => $request->date_de_prise_de_service,
            'role_id' => $request->role_id,
            'service_id' => $request->service_id,
            'password' => Hash::make($password),
        ]);


        //verifier que l'utilisateur a bien été ajouté
        // en voie du mail de notification
        Mail::to($employe->email)->send(new NouvelEmploye($employe, $password));



        return redirect()->back()->with('success', 'Employé ajouté avec succès.');
    }


    public function modifierEmploye(Request $request, $id)
    {
        $employe = User::findOrFail($id);
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|unique:users,telephone,' . $employe->id,
            'fonction' => 'nullable|string|max:255',
            'date_de_prise_de_service' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Mettre à jour l'employé, sans toucher au matricule et email
        $employe->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'fonction' => $request->fonction,
            'date_de_prise_de_service' => $request->date_de_prise_de_service,
            'role_id' => $request->role_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->back()->with('success', 'Employé mis à jour avec succès.');
    }




    public function listeServices()
    {
        $services = Service::all();
        // en voie de la liste des employés donc le role est differnt de GRH
        $employes = User::all();

        return view('grh.listes_services', compact('services', 'employes'));
    }


    public function AjouterService(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $service = Service::create([
            'nom' => $request->nom,
        ]);

        return redirect()->back()->with('success', 'Service ajouté avec succès.');
    }

    public function modifierService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $service->update([
            'nom' => $request->nom,
        ]);

        return redirect()->back()->with('success', 'Service mis à jour avec succès.');
    }


    function listeTypesDemandes()
    {

        $types = TypeDemande::all();
        return view('grh.types_conge', compact('types'));
    }

    function AjouterTypeConge(Request $request)
    {

        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string',
            'duree_min' => 'required|integer',
            'duree_max' => 'required|integer',
        ]);

        $type = TypeDemande::create([
            'libelle' => $request->libelle,
            'description' => $request->description,
            'duree_min' => $request->duree_min,
            'duree_max' => $request->duree_max,
        ]);
        return redirect()->back()->with('success', 'Type de congé ou absence ajouté avec succès.');
    }


    function modifierTypeConge(Request $request, $id)
    {
        $type = TypeDemande::findOrFail($id);

        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string',
            'duree_min' => 'required|integer',
            'duree_max' => 'required|integer',
        ]);

        $type->update([
            'libelle' => $request->libelle,
            'description' => $request->description,
            'duree_min' => $request->duree_min,
            'duree_max' => $request->duree_max,
        ]);
        return redirect()->back()->with('success', 'Type de congé mis à jour avec succès.');
    }
}
