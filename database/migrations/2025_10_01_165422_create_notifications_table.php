<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('idNotification');
            $table->string('message');
            $table->dateTime('date')->nullable();
            $table->string('etat')->default('new');

            $table->unsignedBigInteger('idEvenement')->nullable();
            $table->foreign('idEvenement')->references('idEvenement')->on('evenements')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
