<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
    {
        Schema::create('espaces_verts', function (Blueprint $table) {
            $table->id('idEspace');
            $table->string('nom');
            $table->float('surface')->nullable();
            $table->string('localisation')->nullable();
            $table->string('type')->nullable();

            // Optionnel : rattacher à un projet
            $table->unsignedBigInteger('idProjet')->nullable();
            $table->foreign('idProjet')->references('idProjet')->on('projets')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('espaces_verts');
    }
};
