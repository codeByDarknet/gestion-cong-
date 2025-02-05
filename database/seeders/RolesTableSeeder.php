<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des rôles par défaut
        Role::create(['nom' => 'employé']);
        Role::create(['nom' => 'responsable']);
        Role::create(['nom' => 'GRH']);

    }
}
