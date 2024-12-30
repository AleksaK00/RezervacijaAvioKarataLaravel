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
        Schema::create('nalog', function (Blueprint $table) {
            $table->increments('ID_Naloga');
            $table->date('Datum_Polaska');
            $table->string('Br_Leta', 20);
            $table->string('ICAO_Kod', 6);
            $table->unsignedInteger('ID_Korisnika');
            $table->float('Iznos');

            $table->index(['Datum_Polaska', 'Br_Leta', 'ICAO_Kod', 'ID_Korisnika'], 'fk_nalog_rezervacija');
            $table->primary(['ID_Naloga', 'Datum_Polaska', 'Br_Leta', 'ICAO_Kod', 'ID_Korisnika']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nalog');
    }
};
