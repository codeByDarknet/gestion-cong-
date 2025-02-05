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
        Schema::create('type_demandes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description');
            // dureer minimum de l'absentement en jours
            $table->integer('duree_min');
            // dureer maximum de l'absentement en jours
            $table->integer('duree_max');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_demandes');
    }
};
