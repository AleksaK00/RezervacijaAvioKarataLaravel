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
        Schema::create('instanca_leta', function (Blueprint $table) {
            $table->date('Datum_Polaska');
            $table->string('Br_Leta', 20);
            $table->string('ICAO_Kod', 6);
            $table->string('Registracija', 20)->index('fk_instancaleta_avion');
            $table->float('Cena_Ekonomija')->nullable();
            $table->float('Cena_Premium_Ekonomija')->nullable();
            $table->float('Cena_Biznis')->nullable();
            $table->float('Cena_Prva')->nullable();

            $table->index(['Br_Leta', 'ICAO_Kod'], 'fk_instancaleta_let');
            $table->primary(['Datum_Polaska', 'Br_Leta', 'ICAO_Kod']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instanca_leta');
    }
};
