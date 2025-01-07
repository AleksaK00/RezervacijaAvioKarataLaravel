<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table = 'rezervacija';
    protected $primaryKey = 'ID';
    protected $guarded = [];
    public $timestamps = false;
}
