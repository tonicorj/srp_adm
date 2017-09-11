<?php

namespace App\Http\Controllers;

use App\pfisica;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Dashboard;

class pfisicaController extends Controller
{
    // total de categorias por ano
    public function categorias_ano()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;

        $avisos = new Dashboard();
        $dados = pfisica::__total_categorias_ano($ano);

        return view( 'pfisica.categorias_ano')
            ->with('dados', $dados)
            ->with('avisos', $avisos->avisos($id_categoria))
            ;
    }

    public function categorias_ano_json ()
    {
        $ano = Auth::user()['config']->ano;
        $reg = pfisica::__total_categorias_ano($ano);

        $_data['data'] = $reg;
        $_json = json_encode( $_data );
        return $_json;
    }

    // total de treinamento de uma categorias por ano
    public function treinamentos_ano($id)
    {
        $ano = Auth::user()['config']->ano;

        $avisos = new Dashboard();
        $dados = pfisica::__total_treinamentos_ano($ano, $id);

        return view( 'pfisica.treinamentos_ano')
            ->with('dados', $dados)
            ->with('avisos', $avisos->avisos($id))
            ;
    }

    // total de treinamento de uma categorias por ano
    public function treinos_ano()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;

        $avisos = new Dashboard();
        $dados = pfisica::__total_treinos_ano($ano, $id_categoria);

        return view( 'pfisica.treinos_ano')
            ->with('dados', $dados)
            ->with('avisos', $avisos->avisos($id_categoria))
            ;
    }

    // total de treinamentos de jogadores de uma categorias por ano
    public function jogadores_ano()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;

        $avisos = new Dashboard();
        $dados = pfisica::__total_jogadores_ano($ano, $id_categoria);

        return view( 'pfisica.jogadores_ano')
            ->with('dados', $dados)
            ->with('avisos', $avisos->avisos($id_categoria))
            ;
    }

}
