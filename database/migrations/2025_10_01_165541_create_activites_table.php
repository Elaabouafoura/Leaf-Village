<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id('idActivite');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->date('date')->nullable();

            // Optionnel : rattacher à un projet
            $table->unsignedBigInteger('idProjet')->nullable();
            $table->foreign('idProjet')->references('idProjet')->on('projets')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activites');
    }
};
