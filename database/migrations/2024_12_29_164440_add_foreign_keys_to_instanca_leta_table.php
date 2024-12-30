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
        Schema::table('instanca_leta', function (Blueprint $table) {
            $table->foreign(['Registracija'], 'FK_InstancaLeta_Avion')->references(['Registracija'])->on('avion')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['Br_Leta', 'ICAO_Kod'], 'FK_InstancaLeta_Let')->references(['Br_Leta', 'ICAO_Kod'])->on('let')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instanca_leta', function (Blueprint $table) {
            $table->dropForeign('FK_InstancaLeta_Avion');
            $table->dropForeign('FK_InstancaLeta_Let');
        });
    }
};
