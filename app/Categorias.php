<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    //define os campos atualiz?veis
    protected $fillable = ['id_categoria', 'categ_descricao', 'categ_idade_ini', 'cated_idade_fin', 'id_time', 'categ_tempo_jogo'];
    protected $primaryKey = 'id_categoria';
}
