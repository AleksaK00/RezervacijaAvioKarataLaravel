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
        Schema::table('avion', function (Blueprint $table) {
            $table->foreign(['ICAO_Kod'], 'FK_Avion_AvioKompanija')->references(['ICAO_Kod'])->on('avio_kompanija')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avion', function (Blueprint $table) {
            $table->dropForeign('FK_Avion_AvioKompanija');
        });
    }
};
