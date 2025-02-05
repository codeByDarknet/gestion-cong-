<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;


class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Service::create(['nom' => 'Bibliotheque']);
        Service::create(['nom' => 'Informatique']);
        Service::create(['nom' => 'Comptabilité']);
        Service::create(['nom' => 'Administration']);
    }
}
