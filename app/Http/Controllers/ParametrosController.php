<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Parametros;
use DB;

class ParametrosController extends Controller
{
    //
    public function escudo(){
        // define o totald e usu�rios que usaram o sistema no m�s
        $_sql = 'select id_time from configura ';
        $reg = DB::select($_sql);

        $clube = $reg[0]->id_time;

        $imagem = 'sade.png';
        $imagem = ($clube == 2)?'sade.png':$imagem;
        $imagem = ($clube ==  7)?'palmeiras-sp.png':$imagem;
        $imagem = ($clube == 8)?'fluminense-rj.png':$imagem;
        $imagem = ($clube == 18)?'bahia-rj.png':$imagem;
        $imagem = ($clube == 21)?'sport-pe.png':$imagem;
        $imagem = ($clube == 23)?'goias-go.png':$imagem;
        $imagem = ($clube == 58)?'nautico-pe.png':$imagem;

        return view('parametros.escudo')
            ->with('escudo', $imagem);
    }
}
