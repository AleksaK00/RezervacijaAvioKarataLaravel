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
        Schema::create('avion', function (Blueprint $table) {
            $table->string('Registracija', 20)->primary();
            $table->string('ICAO_Kod', 6)->index('fk_avion_aviokompanija');
            $table->string('Proizvodjac', 120);
            $table->string('Model', 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avion');
    }
};
