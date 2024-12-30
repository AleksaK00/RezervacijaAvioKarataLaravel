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
        Schema::table('rezervacija', function (Blueprint $table) {
            $table->foreign(['Br_Leta', 'ICAO_Kod', 'Datum_Polaska'], 'FK_Rezervacija_InstancaLeta')->references(['Br_Leta', 'ICAO_Kod', 'Datum_Polaska'])->on('instanca_leta')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ID_Korisnika'], 'FK_Rezervacija_Korisnik')->references(['ID_Korisnika'])->on('korisnik')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['Br_Sedista', 'Registracija'], 'FK_Rezervacija_Sedista')->references(['Br_Sedista', 'Registracija'])->on('sediste')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rezervacija', function (Blueprint $table) {
            $table->dropForeign('FK_Rezervacija_InstancaLeta');
            $table->dropForeign('FK_Rezervacija_Korisnik');
            $table->dropForeign('FK_Rezervacija_Sedista');
        });
    }
};
