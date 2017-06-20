<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Dashboard;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests;
//use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id_categoria = Auth::user()->categoria_selecionada();
        $avisos = new Dashboard();

        $dashboard = array(
            'jogadores_profissionais' => $avisos->atletas_profissionais($id_categoria),
            'jogadores_dm' => $avisos->atletas_dm($id_categoria),
            'artilheiros' => $avisos->artilheiros_ano(),
            'jogadores_cartoes' => $avisos->cartoes(),

            // administrativo
            'adm_ocorrencias' => $avisos->adm_ocorrencias(),

            // dep. futebol
            'qts_total' => $avisos->qts_total($id_categoria),
            'jogos_total' => $avisos->jogos_total($id_categoria),

            // quadro de atividades
            'qts_dia' => $avisos->qts_data($id_categoria),
            'painel_contratos' => $avisos->painel_contratos($id_categoria),
            'proximos_jogos' => $avisos->avisos_jogos($id_categoria),
            'ultimos_jogos' => $avisos->avisos_jogos_ultimos($id_categoria),
            'aniversariantes' => $avisos->avisos_aniversariantes(),

            // contratos
            'contrato_vlr_simples' => $avisos->vlr_simples(),
            'contrato_vlr_produtividade' => $avisos->vlr_produtividade(),
            'contrato_vlr_total' => $avisos->vlr_total(),
        );

        $contratos = new Contratos();
        return view('welcome')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria))
            ->with('contratos_mes', $contratos->contratos_total_mes())
            ;

    }
}
