<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //define os campos atualiz?veis
    protected $fillable = ['usuario', 'data_hora', 'mensagem'];
    protected $primaryKey = 'data_hora';
}
