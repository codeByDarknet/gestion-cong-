<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\GRhController;
use App\Http\Controllers\DemandesController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\LoginController;

// Routes de connexion et de déconnexion
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);
Route::post('/deconnexion', [LoginController::class, 'logout'])->name('deconnexion');


// Groupe de routes consernant  tout les GRH
Route::middleware('role:GRH')->group(function () {
    Route::get('/grh-dashboard', [GRhController::class, 'dashboard'])->name('grh.dashboard');
    Route::get('/toutes-les-demandes', [GRhController::class, 'toutesLesDemandes'])->name('demandes.toutes');
    Route::get('/liste-des-employes', [GRhController::class, 'listeEmployes'])->name('employes.liste');
    Route::post('/ajouter-employe', [GRhController::class, 'ajouterEmploye'])->name('employes.ajouter');
    // vous devez ajouter ici que les routes concernant les GRH

});



// Groupe de routes consernant  tout les employés
Route::middleware('role:employé')->group(function () {

    Route::get('/employe-dashboard', [EmployeController::class, 'dashboard'])->name('employe.dashboard');

    // vous devez ajouter ici que les routes concernant les employés

});

// Groupe de routes consernant  tout les responsables
Route::middleware('role:responsable')->group(function () {
    Route::get('/responsable-dashboard', [ResponsableController::class, 'dashboard'])->name('responsable.dashboard');

    // vous devez ajouter ici que les routes concernant les responsables

});
