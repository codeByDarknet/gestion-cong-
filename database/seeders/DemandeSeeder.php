<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Demande;
use App\Models\User;
use App\Models\TypeDemande;

class DemandeSeeder extends Seeder
{
    /**
     * Exécute les insertions de données dans la table demandes.
     */
    public function run()
    {
        // Supprimer les anciennes demandes (optionnel)
        DB::table('demandes')->truncate();

        // Récupérer des utilisateurs
        $employe = User::where('email', 'abdoul@gmail.com')->first();
        $responsable = User::where('email', 'mohamed@gmail.com')->first();
        $grh = User::where('email', 'alassane@gmail.com')->first();

        // Récupérer des types de demandes
        $typeCongePaye = TypeDemande::where('libelle', 'Congé payé')->first();
        $typeMaternite = TypeDemande::where('libelle', 'Maternité')->first();
        $typePaternite = TypeDemande::where('libelle', 'Paternité')->first();

        // Ajouter des demandes
        Demande::create([
            'user_id' => $employe->id,
            'type_demande_id' => $typeCongePaye->id,
            'date_debut' => '2024-06-10',
            'date_fin' => '2024-06-20',
            'motif' => 'Vacances annuelles',
            'statut' => 'Demandée',
        ]);

        Demande::create([
            'user_id' => $responsable->id,
            'type_demande_id' => $typeMaternite->id,
            'date_debut' => '2024-08-01',
            'date_fin' => '2024-10-01',
            'motif' => 'Maternité',
            'statut' => 'Plannifiée',
        ]);

        Demande::create([
            'user_id' => $grh->id,
            'type_demande_id' => $typePaternite->id,
            'date_debut' => '2024-07-15',
            'date_fin' => '2024-07-30',
            'motif' => 'Naissance de mon enfant',
            'statut' => 'Acceptée',
        ]);
    }
}
