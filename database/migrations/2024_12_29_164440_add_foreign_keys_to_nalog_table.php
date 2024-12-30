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
        Schema::table('nalog', function (Blueprint $table) {
            $table->foreign(['Datum_Polaska', 'Br_Leta', 'ICAO_Kod', 'ID_Korisnika'], 'FK_Nalog_Rezervacija')->references(['Datum_Polaska', 'Br_Leta', 'ICAO_Kod', 'ID_Korisnika'])->on('rezervacija')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nalog', function (Blueprint $table) {
            $table->dropForeign('FK_Nalog_Rezervacija');
        });
    }
};
