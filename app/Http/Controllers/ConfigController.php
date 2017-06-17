<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Support\Facades\Session;

//use App\User;
//use Illuminate\Http\Request;
//use App\Http\Requests;

class ConfigController extends Controller
{
    public static function altera_categoria ($id_categoria){
        Session::put('ID_CATEGORIA_ATUAL', $id_categoria);
        return Config::categoria_descricao();
    }

}
