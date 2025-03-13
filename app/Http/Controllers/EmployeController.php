<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\TypeDemande;
use Illuminate\Support\Facades\Auth;



class EmployeController extends Controller
{
    //
    public function accueil()
    {

        $mes_demandes = Demande::where('user_id', auth()->user()->id)->get();
        $types = TypeDemande::all();

        return view('employe.accueil', compact('mes_demandes', 'types'));
    }

    public function historique()
    {

        $user = Auth::user();

        // Filtrer les demandes appartenant à cet utilisateur avec les statuts "Acceptée" ou "Rejetée"
        $demandes = Demande::where('user_id', $user->id)
            ->whereIn('statut', ['Acceptée', 'Rejetée'])
            ->get();
        $types = TypeDemande::all();

        return view('employe.historique', compact('demandes', 'types'));
    }
}
