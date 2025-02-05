<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class GRhController extends Controller
{
    //
    public function dashboard()
    {
        return view('grh.dashboard');
    }

    public function touteslesdemandes()
    {

        $demandes = Demande::all();
        return view('grh.listes_demandes', compact('demandes'));
    }

    public function listeEmployes()
    {

        // retourne la liste des employés de tout les employés sauf le GRH
        $employes = User::where('role_id', '!=', 2)->get();
        $services = Service::all();
        $roles = Role::all();

        return view('grh.listes_employes', compact('employes', 'services', 'roles'));

    }

    public function AjouterEmploye(Request $request)
    {


            $request->validate([
                'matricule' => 'required|unique:users,matricule',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'telephone' => 'required|string|unique:users,telephone',
                'fonction' => 'nullable|string|max:255',
                'date_de_prise_de_service' => 'nullable|date',
                'role_id' => 'required|exists:roles,id',
                'service_id' => 'required|exists:services,id',
                'password' => 'required|string|min:8',
            ]);

            User::create([
                'matricule' => $request->matricule,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'fonction' => $request->fonction,
                'date_de_prise_de_service' => $request->date_de_prise_de_service,
                'role_id' => $request->role_id,
                'service_id' => $request->service_id,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Utilisateur ajouté avec succès.');
        }
}


