<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id('idRessource');
            $table->string('nom');
            $table->string('type')->nullable();
            $table->integer('quantite')->default(0);

            $table->unsignedBigInteger('idActivite')->nullable();
            $table->unsignedBigInteger('idFournisseur')->nullable();

            $table->foreign('idActivite')->references('idActivite')->on('activites')->onDelete('cascade');
            $table->foreign('idFournisseur')->references('idFournisseur')->on('fournisseurs')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ressources');
    }
};
