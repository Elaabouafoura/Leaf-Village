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
        Schema::create('evenement_user', function (Blueprint $table) {
            $table->id(); // Clé primaire

            // Clé étrangère vers users
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')
                  ->references('idUser')
                  ->on('users')
                  ->onDelete('cascade');

            // Clé étrangère vers evenements
            $table->unsignedBigInteger('idEvenement');
            $table->foreign('idEvenement')
                  ->references('idEvenement')
                  ->on('evenements')
                  ->onDelete('cascade');

            // (Optionnel) Colonnes supplémentaires
            $table->timestamp('inscrit_le')->nullable(); // exemple : date d’inscription à l’événement
            $table->string('statut_participation')->default('inscrit'); // exemple : statut de participation

            $table->timestamps(); // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenement_user');
    }
};
