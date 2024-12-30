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
        Schema::create('rezervacija', function (Blueprint $table) {
            $table->date('Datum_Polaska');
            $table->string('Br_Leta', 20);
            $table->string('ICAO_Kod', 6);
            $table->unsignedInteger('ID_Korisnika')->index('fk_rezervacija_korisnik');
            $table->string('Br_Sedista', 4)->nullable();
            $table->string('Registracija', 20)->nullable();
            $table->integer('Br_Karata');
            $table->enum('Klasa', ['Ekonomija', 'Premium ekonomija', 'Biznis', 'Prva klasa']);

            $table->index(['Br_Leta', 'ICAO_Kod', 'Datum_Polaska'], 'fk_rezervacija_instancaleta');
            $table->index(['Br_Sedista', 'Registracija'], 'fk_rezervacija_sedista');
            $table->primary(['Datum_Polaska', 'Br_Leta', 'ICAO_Kod', 'ID_Korisnika']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezervacija');
    }
};
