<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Renommer la colonne 'password' en 'motDePasse'
            $table->renameColumn('password', 'motDePasse');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revenir en arrière si besoin
            $table->renameColumn('motDePasse', 'password');
        });
    }
};
