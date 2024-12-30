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
        Schema::create('sediste', function (Blueprint $table) {
            $table->string('Br_Sedista', 4);
            $table->string('Registracija', 20)->index('fk_sediste_avion');
            $table->enum('Klasa', ['Ekonomija', 'Premium ekonomija', 'Biznis', 'Prva klasa']);

            $table->primary(['Br_Sedista', 'Registracija']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sediste');
    }
};
