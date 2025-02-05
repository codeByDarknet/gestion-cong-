<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_demandes')->insert([
            [
                'libelle' => 'Congé payé',
                'description' => 'Demande de congé annuel rémunéré.',
                'duree_min' => 1,
                'duree_max' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Maternité',
                'description' => 'Congé de maternité pour les employées.',
                'duree_min' => 30,
                'duree_max' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Paternité',
                'description' => 'Congé de paternité pour les employés.',
                'duree_min' => 3,
                'duree_max' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Compensation',
                'description' => 'Congé pour récupération d’heures supplémentaires.',
                'duree_min' => 1,
                'duree_max' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Maladie',
                'description' => 'Absence pour raison médicale avec certificat.',
                'duree_min' => 1,
                'duree_max' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
