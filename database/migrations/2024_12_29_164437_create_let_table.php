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
        Schema::create('let', function (Blueprint $table) {
            $table->string('Br_Leta', 20);
            $table->string('ICAO_Kod', 6)->index('fk_let_aviokompanija');
            $table->string('Polazni_Aerodrom', 6)->index('fk_let_aerodrom_polazni');
            $table->string('Dolazni_Aerodrom', 6)->index('fk_let_aerodrom_dolazni');
            $table->time('Vreme_Polaska');

            $table->primary(['Br_Leta', 'ICAO_Kod']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('let');
    }
};
