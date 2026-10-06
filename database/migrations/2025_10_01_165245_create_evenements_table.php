<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id('idEvenement');
            $table->string('nom');
            $table->date('date')->nullable();
            $table->string('lieu')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('idProjet')->nullable();
            $table->foreign('idProjet')->references('idProjet')->on('projets')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evenements');
    }
};
