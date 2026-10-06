<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('idFeedback');
            $table->text('commentaire')->nullable();
            $table->tinyInteger('note'); // (1..5) selon diagramme
            $table->date('date')->nullable();

            $table->unsignedBigInteger('idActivite');
            $table->unsignedBigInteger('idUser');

            $table->foreign('idActivite')->references('idActivite')->on('activites')->onDelete('cascade');
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
};
