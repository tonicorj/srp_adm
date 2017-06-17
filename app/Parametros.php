<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Parametros extends Model
{
    //
    protected $fillable = ['campo', 'valor'];
    protected $primaryKey = 'campo';
}
