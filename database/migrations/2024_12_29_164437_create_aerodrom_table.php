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
        Schema::create('aerodrom', function (Blueprint $table) {
            $table->string('ICAO_Kod_Aerodroma', 6)->primary();
            $table->string('Grad', 60);
            $table->string('Ime', 120);
            $table->string('Drzava', 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aerodrom');
    }
};
