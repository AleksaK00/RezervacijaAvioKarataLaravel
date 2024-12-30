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
        Schema::create('korisnik', function (Blueprint $table) {
            $table->increments('ID_Korisnika');
            $table->string('Korisnicko_Ime', 100)->unique('uq_korisnickoime');
            $table->string('Sifra', 100);
            $table->string('Ime', 30);
            $table->string('Prezime', 30);
            $table->string('Email', 40)->unique('email');
            $table->string('Adresa', 120);
            $table->boolean('Administrator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korisnik');
    }
};
