<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocija extends Model
{
    protected $table = 'promocija';
    protected $primaryKey = 'ID';
    protected $guarded = [];
    public $timestamps = false;
}
