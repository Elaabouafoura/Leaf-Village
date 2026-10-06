<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
    {
        Schema::create('activite_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idActivite');
            $table->unsignedBigInteger('idUser');
            $table->timestamps();

            $table->foreign('idActivite')->references('idActivite')->on('activites')->onDelete('cascade');
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');

            $table->unique(['idActivite', 'idUser']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('activite_user');
    }
};
