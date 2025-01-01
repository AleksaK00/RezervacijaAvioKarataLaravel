<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PojedinacniRezultat extends Model
{
    public Let $let;
    public AvioKompanija $avioKompanija;
    public Aerodrom $dolazniAerodrom;
    public Aerodrom $polazniAerodrom;

    protected $guarded = [];

    //Vraca najnizu cenu instance leta iz trenutnog rezultata
    public function CenaOd()
    {
        return InstancaLeta::select('Cena_Ekonomija')->where('Br_Leta', 'like', '%' . $this->let['Br_Leta']. '%' )->where('Datum_Polaska', '>', date('Y-m-d'))->min('Cena_Ekonomija');
    }

}
