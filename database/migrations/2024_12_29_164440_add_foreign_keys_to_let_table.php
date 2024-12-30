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
        Schema::table('let', function (Blueprint $table) {
            $table->foreign(['Dolazni_Aerodrom'], 'FK_Let_Aerodrom_Dolazni')->references(['ICAO_Kod_Aerodroma'])->on('aerodrom')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['Polazni_Aerodrom'], 'FK_Let_Aerodrom_Polazni')->references(['ICAO_Kod_Aerodroma'])->on('aerodrom')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ICAO_Kod'], 'FK_Let_AvioKompanija')->references(['ICAO_Kod'])->on('avio_kompanija')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('let', function (Blueprint $table) {
            $table->dropForeign('FK_Let_Aerodrom_Dolazni');
            $table->dropForeign('FK_Let_Aerodrom_Polazni');
            $table->dropForeign('FK_Let_AvioKompanija');
        });
    }
};
