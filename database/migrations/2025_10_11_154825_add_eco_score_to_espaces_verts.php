<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('espaces_verts', function (Blueprint $table) {
            $table->unsignedSmallInteger('eco_score')->nullable()->after('type');
            $table->text('eco_justification')->nullable()->after('eco_score');
        });
    }

    public function down(): void
    {
        Schema::table('espaces_verts', function (Blueprint $table) {
            $table->dropColumn(['eco_score', 'eco_justification']);
        });
    }
};
