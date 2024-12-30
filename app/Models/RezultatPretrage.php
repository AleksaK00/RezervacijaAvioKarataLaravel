<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RezultatPretrage extends Model
{
    public $rezultatNiz = array();

    //Niz podataka potrebnih za filtriranje
    public $podaciZaFilter = array(
        "minCena" => 0,
        "maxCena" => 0,
        "polazniAerodromi" => array(),
        "dolazniAerodromi" => array(),
        "avioKompanije" => array()
    );

    protected $guarded = [];
}
