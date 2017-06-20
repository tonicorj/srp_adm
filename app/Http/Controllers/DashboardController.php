<?php

namespace App\Http\Controllers;

use App\Contratos;
use App\Dashboard;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $mes;
    private $ano;
    private $id_categoria;

    // lista de logins que não contam nas estatísticas
    private $filtro_usuarios = "'tonico', 'sade_suporte', 'alex', 'leo'";

    public function index()
    {
        $id_categoria = Auth::user()->categoria_selecionada();

        // avisos
        $avisos = new Dashboard;

        $dashboard = array(
            'jogadores_chegaram' => $avisos->atletas_chegaram(),
            'jogadores_sairam' => $avisos->atletas_sairam(),
            'jogadores_profissionais' => $avisos->atletas_profissionais($id_categoria),
            'jogadores_dm' => $avisos->atletas_dm($id_categoria),
            'jogadores_grupoesp' => $avisos->atletas_grupoespecial($id_categoria),
            'jogadores_emprestados' => $avisos->atletas_grupoemprestados($id_categoria),
            'jogadores_base' => $avisos->atletas_base(),
            'artilheiros' => $avisos->artilheiros_ano(),
            'jogadores_cartoes' => $avisos->cartoes(),

            // administrativo
            'alojamento_chegaram' => $avisos->alojamento_chegaram(),
            'alojamento_sairam' => $avisos->alojamento_sairam(),
            'adm_mudancasCategoria' => $avisos->adm_mudancasCategoria(),
            'adm_ocorrencias' => $avisos->adm_ocorrencias(),
            'funcionarios_qtd' => $avisos->funcionarios_qtd(),

            'dm_acompanhamentos' => $avisos->dm_acompanhamentos(),
            'dm_entradas' => $avisos->dm_entradas(),
            'dm_exames' => $avisos->dm_exames(),
            'dm_cirurgias' => $avisos->dm_cirurgias(),

            'fisiologia_atendimentos' => $avisos->fisiologia_atendimentos(),
            'fisioterapia_atendimentos' => $avisos->fisioterapia_atendimentos(),
            'prepfisica_atendimentos' => $avisos->prepfisica_atendimentos(),
            'prepfisica_jogadores' => $avisos->prepfisica_jogadores(),
            'entrevistas_total' => $avisos->entrevistas_total(),

            // dep. futebol
            'qts_total' => $avisos->qts_total($id_categoria),
            'jogos_total' => $avisos->jogos_total($id_categoria),
            'viagens_total' => $avisos->viagens_total($id_categoria),

            'servsocial_atendimentos' => $avisos->servsocial_atendimentos(),
            'servsocial_estudantes' => $avisos->servsocial_estudantes(),
            'psicologia_atendimentos' => $avisos->psicologia_atendimentos(),
            'nutricao_atendimentos' => $avisos->nutricao_atendimentos(),

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

            // acessos
            'total_mes' => $avisos->total_mes(),
            'usuarios_mes' => $avisos->usuarios_mes(),
            'usuarios_unicos' => $avisos->usuarios_unicos(),
            'departamentos_unicos' => $avisos->departamentos_unicos(),
        );
        //return dd($dashboard);

        // contratos
        $contratos = new Contratos;

        return view('dashboard.index')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria))
            ->with('contratos_mes', $contratos->contratos_total_mes())
            ;
    }

    public function __construct(Dashboard $ds)
    {
        $this->mes = Auth::user()['config']->mes;
        $this->ano = Auth::user()['config']->ano;
        $this->id_categoria = Auth::user()->categoria_selecionada();

    }

    //*** Chamadas do DashBoard
    public function jogadores()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;
        $dashboard = array(
            // jogadores
            'jogadores_chegaram' => $avisos->atletas_chegaram(),
            'jogadores_sairam' => $avisos->atletas_sairam(),
            'jogadores_profissionais' => $avisos->atletas_profissionais($id_categoria),
            'jogadores_dm' => $avisos->atletas_dm($id_categoria),
            'jogadores_grupoesp' => $avisos->atletas_grupoespecial($id_categoria),
            'jogadores_emprestados' => $avisos->atletas_grupoemprestados($id_categoria),
            'jogadores_base' => $avisos->atletas_base(),
        );
        return view('dashboard.ds_jogadores')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }

    public function depfutebol()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;
        $dashboard = array(
            // dep. futebol
            'qts_total' => $avisos->qts_total($id_categoria),
            'jogos_total' => $avisos->jogos_total($id_categoria),
            'viagens_total' => $avisos->viagens_total($id_categoria),
        );

        return view('dashboard.ds_depfutebol')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }

    public function depmedico()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;
        $dashboard = array(
            // dep. médico
            'dm_acompanhamentos' => $avisos->dm_acompanhamentos(),
            'dm_entradas' => $avisos->dm_entradas(),
            'dm_exames' => $avisos->dm_exames(),
            'dm_cirurgias' => $avisos->dm_cirurgias(),
        );
        return view('dashboard.ds_depmedico')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }


    public function acessodep()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;
        $dashboard = array(
            // dep. futebol
            'qts_total' => $avisos->qts_total($id_categoria),
            'jogos_total' => $avisos->jogos_total($id_categoria),
            'viagens_total' => $avisos->viagens_total($id_categoria),

            'servsocial_atendimentos' => $avisos->servsocial_atendimentos(),
            'servsocial_estudantes' => $avisos->servsocial_estudantes(),
            'psicologia_atendimentos' => $avisos->psicologia_atendimentos(),
            'nutricao_atendimentos' => $avisos->nutricao_atendimentos(),

            'fisiologia_atendimentos' => $avisos->fisiologia_atendimentos(),
            'fisioterapia_atendimentos' => $avisos->fisioterapia_atendimentos(),
            'prepfisica_atendimentos' => $avisos->prepfisica_atendimentos(),
            'prepfisica_jogadores' => $avisos->prepfisica_jogadores(),
            'entrevistas_total' => $avisos->entrevistas_total(),
        );
        return view('dashboard.ds_acessodep')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }

    public function admin()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;

        $dashboard = array(
            // admin
            'alojamento_chegaram' => $avisos->alojamento_chegaram(),
            'alojamento_sairam' => $avisos->alojamento_sairam(),
            'adm_mudancasCategoria' => $avisos->adm_mudancasCategoria(),
            'adm_ocorrencias' => $avisos->adm_ocorrencias(),
            'funcionarios_qtd' => $avisos->funcionarios_qtd(),
        );

        return view('dashboard.ds_admin')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }

    public function acessos()
    {
        $id_categoria = $this->id_categoria;
        $avisos = new Dashboard;
        $dashboard = array(
            // acessos
            'total_mes' => $avisos->total_mes(),
            'usuarios_mes' => $avisos->usuarios_mes(),
            'usuarios_unicos' => $avisos->usuarios_unicos(),
            'departamentos_unicos' => $avisos->departamentos_unicos(),
        );

        return view('dashboard.ds_acessos')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
    }
}
