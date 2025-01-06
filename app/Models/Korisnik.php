<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    protected $table = 'korisnik';
    protected $primaryKey = 'ID_Korisnika';
    protected $guarded = [];
    public $timestamps = false;
}
