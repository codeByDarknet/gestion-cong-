<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;

class UsersTableSeeder extends Seeder
{
    /**
     * Exécute les insertions de données dans la table users.
     */
    public function run()
    {
        // Désactiver temporairement les clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Supprimer les enregistrements sans supprimer la table
        DB::table('users')->delete();

        // Réactiver les clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Récupérer les rôles et services existants
        $roleEmploye = Role::where('nom', 'employé')->first();
        $roleResponsable = Role::where('nom', 'responsable')->first();
        $roleGRH = Role::where('nom', 'GRH')->first();

        $serviceBibliotheque = Service::where('nom', 'Bibliotheque')->first();
        $serviceInformatique = Service::where('nom', 'Informatique')->first();
        $serviceComptabilite = Service::where('nom', 'Comptabilité')->first();

        // Ajouter des utilisateurs
        User::create([
            'matricule' => 'EMP001',
            'nom' => 'Ouedraogo',
            'prenom' => 'Abdoul Razack',
            'email' => 'abdoul@gmail.com',
            'fonction' => 'Développeur',
            'telephone' => '0123456789',
            'date_de_prise_de_service' => '2023-01-01',
            'password' => Hash::make('passe1234'),
            'role_id' => $roleEmploye->id,
            'service_id' => $serviceInformatique->id,
        ]);

        User::create([
            'matricule' => 'RESP001',
            'nom' => 'Ouedraogo',
            'prenom' => 'Mohamed',
            'email' => 'mohamed@gmail.com',
            'fonction' => 'secrétaire',
            'telephone' => '0987654321',
            'date_de_prise_de_service' => '2022-06-15',
            'password' => Hash::make('passe1234'),
            'role_id' => $roleResponsable->id,
            'service_id' => $serviceBibliotheque->id,
        ]);

        User::create([
            'matricule' => 'GRH001',
            'nom' => 'KOLOGO',
            'prenom' => 'Alassane',
            'email' => 'alassane@gmail.com',
            'fonction' => 'GRH',
            'telephone' => '0555666777',
            'date_de_prise_de_service' => '2021-03-10',
            'password' => Hash::make('passe1234'),
            'role_id' => $roleGRH->id,
            'service_id' => $serviceComptabilite->id,
        ]);




        // Ajouter des employés au service de Mohamed (Bibliothèque)
        $employeesBibliotheque = [
            [
                'matricule' => 'EMP002',
                'nom' => 'Sanou',
                'prenom' => 'Aminata',
                'email' => 'aminata.sanou@gmail.com',
                'fonction' => 'Assistante bibliothécaire',
                'telephone' => '0678901234',
                'date_de_prise_de_service' => '2023-04-10',
            ],
            [
                'matricule' => 'EMP003',
                'nom' => 'Zongo',
                'prenom' => 'Issouf',
                'email' => 'issouf.zongo@gmail.com',
                'fonction' => 'Archiviste',
                'telephone' => '0789012345',
                'date_de_prise_de_service' => '2022-11-20',
            ],
            [
                'matricule' => 'EMP004',
                'nom' => 'Sawadogo',
                'prenom' => 'Fatima',
                'email' => 'fatima.sawadogo@gmail.com',
                'fonction' => 'Technicienne documentaliste',
                'telephone' => '0567890123',
                'date_de_prise_de_service' => '2024-02-01',
            ],
        ];

    foreach ($employeesBibliotheque as $employee) {
        User::create([
            'matricule' => $employee['matricule'],
            'nom' => $employee['nom'],
            'prenom' => $employee['prenom'],
            'email' => $employee['email'],
            'fonction' => $employee['fonction'],
            'telephone' => $employee['telephone'],
            'date_de_prise_de_service' => $employee['date_de_prise_de_service'],
            'password' => Hash::make('passe1234'),
            'role_id' => $roleEmploye->id,
            'service_id' => $serviceBibliotheque->id,
        ]);
    }

}
}
