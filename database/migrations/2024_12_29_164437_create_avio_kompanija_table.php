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
        Schema::create('avio_kompanija', function (Blueprint $table) {
            $table->string('ICAO_Kod', 6)->primary();
            $table->string('Ime', 60);
            $table->string('Drzava_Porekla', 40);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avio_kompanija');
    }
};
