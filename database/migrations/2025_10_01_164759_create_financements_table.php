<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('financements', function (Blueprint $table) {
            $table->id('idFinancement');
            $table->float('montant')->default(0);
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();

            // FK
            $table->unsignedBigInteger('idPartenaire');
            $table->unsignedBigInteger('idProjet');

            $table->foreign('idPartenaire')->references('idPartenaire')->on('partenaires')->onDelete('cascade');
            $table->foreign('idProjet')->references('idProjet')->on('projets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financements');
    }
};
