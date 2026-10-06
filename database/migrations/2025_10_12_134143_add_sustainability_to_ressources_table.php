<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('ressources', function (Blueprint $table) {
    $table->string('material')->nullable();
    $table->string('co2_impact')->nullable();
    $table->string('eco_alternative')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ressources', function (Blueprint $table) {
    $table->dropColumn(['material', 'co2_impact', 'eco_alternative']);
});

    }
};
