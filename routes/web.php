<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\GRhController;
use App\Http\Controllers\DemandesController;





// la route de la page d'accueil doit revoyer notre landing page
Route::get('/', function () {
    return view('home');
})->name('home');

use App\Http\Controllers\LoginController;
use Illuminate\Contracts\Support\Responsable;

// Routes de connexion et de déconnexion
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);
Route::get('/deconnexion', [LoginController::class, 'logout'])->name('deconnexion');




//



// Groupe de routes consernant  tout les GRH
Route::middleware(['auth', 'role:GRH'])->group(function () {
    Route::get('/grh-dashboard', [GRhController::class, 'dashboard'])->name('grh.dashboard');
    Route::get('/toutes-les-demandes', [GRhController::class, 'toutesLesDemandes'])->name('demandes.toutes');
    Route::get('/liste-des-employes', [GRhController::class, 'listeEmployes'])->name('employes.liste');
    Route::post('/ajouter-employe', [GRhController::class, 'ajouterEmploye'])->name('employes.ajouter');
    Route::put('/modifier-employe/{id}', [GRhController::class, 'modifierEmploye'])->name('employes.modifier');
    Route::get('/liste-des-services', [GRhController::class, 'listeServices'])->name('services.liste');
    Route::post('/ajouter-service', [GRhController::class, 'ajouterService'])->name('services.ajouter');
    Route::put('/modifier-service/{id}', [GRhController::class, 'modifierService'])->name('services.modifier');

    Route::get('/types-de-conges-absences', [GRhController::class, 'listeTypesDemandes'])->name('typesdemandes.liste');
    Route::post('/ajouter-type-demande', [GRhController::class, 'ajouterTypeConge'])->name('typesdemandes.ajouter');
    Route::put('/modifier-type-demande/{id}', [GRhController::class, 'modifierTypeConge'])->name('typesdemandes.modifier');



    // operations sur les demandes

    Route::post('grh/demande/{id}/accepter', [DemandesController::class, 'accepter'])->name('demande.accepter');
    Route::post('grh/demande/{id}/rejeter', [DemandesController::class, 'rejeter'])->name('demande.rejeter');

    Route::post('grh/demande/{id}/modifier-demande', [DemandesController::class, 'traiterModification'])->name('demande.traiter-modification');




    // vous devez ajouter ici que les routes concernant les GRH

});

// Groupe de routes consernant  tout les employés
Route::middleware(['auth', 'role:employé'])->group(function () {

    Route::get('/employe-accueil', [EmployeController::class, 'accueil'])->name('employe.accueil');
    Route::get('/employe-historique', [EmployeController::class, 'historique'])->name('employe.historique');
    Route::post('/planifier-demande', [DemandesController::class, 'planifierDemande'])->name('demande.planifier');
    Route::put('/soumettre-demande/{id}', [DemandesController::class, 'soumettreDemande'])->name('demande.soumettre');
    Route::put('/modifier-demande/{id}', [DemandesController::class, 'modifierDemande'])->name('demande.modifier');

    Route::put('/demande-modification/{id}', [DemandesController::class, 'demanderModification'])->name('demande.demander.modification');
    Route::put('/demande-relancement/{id}', [DemandesController::class, 'demanderRelancement'])->name('demande.relancement');


    Route::delete('/supprimer-demande{id}', [DemandesController::class, 'supprimerDemande'])->name('demande.supprimer');
   // vous devez ajouter ici que les routes concernant les employés

});

// Groupe de routes consernant  tout les responsables
Route::middleware(['auth', 'role:responsable'])->group(function () {
    Route::get('/responsable-dashboard', [ResponsableController::class, 'dashboard'])->name('responsable.dashboard');
    Route::get('/responsable-demandes-personnel',[ResponsableController::class,'demandesPersonnel'])->name('resposanble.demandes.personnel');
    Route::get('/responsable-demandes-Employes',[ResponsableController::class,'demandesEmployes'])->name('resposanble.demandes.employes');
    Route::get('responsable-historique-demandes',[ResponsableController::class,'historiquesDeMesDemandes'])->name('responsable.demandes.historique');

    Route::post('responsable/demande/{id}/accepter', [DemandesController::class, 'accepter'])->name('responsable.demande.accepter');
    Route::post('responsable/demande/{id}/rejeter', [DemandesController::class, 'rejeter'])->name('responsable.demande.rejeter');

    Route::post('responsable/planifier-demande', [DemandesController::class, 'planifierDemande'])->name('responsable.demande.planifier');
    Route::put('responsable/soumettre-demande/{id}', [DemandesController::class, 'soumettreDemande'])->name('responsable.demande.soumettre');
    Route::put('responsable/modifier-demande/{id}', [DemandesController::class, 'modifierDemande'])->name('responsable.demande.modifier');
    Route::put('/demande-modification-responsable/{id}', [DemandesController::class, 'demanderModification'])->name('responsable.demande.demander.modification');


    Route::delete('responsable/supprimer-demande{id}', [DemandesController::class, 'supprimerDemande'])->name('responsable.demande.supprimer');


    Route::get('/responsable/liste-des-employes', [ResponsableController::class, 'listeEmployes'])->name('responsable.employes.liste');


});
