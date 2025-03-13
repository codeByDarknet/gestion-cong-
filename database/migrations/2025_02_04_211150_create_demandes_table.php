<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Clé étrangère facultative
            $table->foreignId('type_demande_id')->nullable()->constrained('type_demandes')->onDelete('set null');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('motif');
            $table->string('piece_jointe')->nullable();
            $table->text('commentaire_modification')->nullable();
            $table->boolean('modication_urgente')->default(false);
            $table->boolean('relancer')->default(false);
            $table->enum('statut', ['Plannifiée', 'Demandée', 'Acceptée', 'Rejetée'])->default('Plannifiée');
            $table->timestamps();

            // Clé étrangère vers les utilisateurs

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
