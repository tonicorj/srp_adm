<?php

namespace App\Http\Controllers;

use App\Log;
use DB;

class DashboardController extends Controller
{
    //
    private $log;
    private $mes;
    private $ano;

    private $dashboard;
    private $id_categoria;

    // lista de logins que não contam nas estatísticas
    private $filtro_usuarios = "'tonico', 'sade_suporte', 'alex', 'leo'";

    public function index()
    {
        $id_categoria = 1;

        $dashboard = array(
            'jogadores_chegaram' => $this->atletas_chegaram(),
            'jogadores_sairam' => $this->atletas_sairam(),
            'jogadores_profissionais' => $this->atletas_profissionais($id_categoria),
            'jogadores_dm' => $this->atletas_dm($id_categoria),
            'jogadores_grupoesp' => $this->atletas_grupoespecial($id_categoria),
            'jogadores_emprestados' => $this->atletas_grupoespecial($id_categoria),
            'jogadores_base' => $this->atletas_base(),

            'adm_mudancasCategoria' => $this->adm_mudancasCategoria(),
            'adm_ocorrencias' => $this->adm_ocorrencias(),
            'funcionarios_qtd' => $this->funcionarios_qtd(),

            'alojamento_chegaram' => $this->alojamento_chegaram(),
            'alojamento_sairam' => $this->alojamento_sairam(),

            'dm_acompanhamentos' => $this->dm_acompanhamentos(),
            'dm_entradas' => $this->dm_entradas(),
            'dm_exames' => $this->dm_exames(),
            'dm_cirurgias' => $this->dm_cirurgias(),

            'fisiologia_atendimentos' => $this->fisiologia_atendimentos(),
            'fisioterapia_atendimentos' => $this->fisioterapia_atendimentos(),
            'prepfisica_atendimentos' => $this->prepfisica_atendimentos(),
            'prepfisica_jogadores' => $this->prepfisica_jogadores(),
            'entrevistas_total' => $this->entrevistas_total(),

            // dep. futebol
            'qts_total' => $this->qts_total($id_categoria),
            'jogos_total' => $this->jogos_total($id_categoria),
            'viagens_total' => $this->viagens_total($id_categoria),

            'servsocial_atendimentos' => $this->servsocial_atendimentos(),
            'servsocial_estudantes' => $this->servsocial_estudantes(),
            'psicologia_atendimentos' => $this->psicologia_atendimentos(),
            'nutricao_atendimentos' => $this->nutricao_atendimentos(),

            // acessos
            'total_mes' => $this->total_mes(),
            'usuarios_mes' => $this->usuarios_mes(),
            'usuarios_unicos' => $this->usuarios_unicos(),
            'departamentos_unicos' => $this->departamentos_unicos(),

            // AVISOS
            'avisos_ocorrencias' => $this->avisos_ocorrencias($id_categoria),

            'escudo' => 'palmeiras-sp.png',
        );

        //return dd($dashboard );

        return view('dashboard.index')
            ->with('db', $dashboard);
    }

    public function __construct(Log $log)
    {
        $this->log = $log;

        $mess = date('M');
        $this->ano = date('Y');

        if ($mess == "Jan") $this->mes = "01";
        if ($mess == "Feb") $this->mes = "02";
        if ($mess == "Mar") $this->mes = "03";
        if ($mess == "Apr") $this->mes = "04";
        if ($mess == "May") $this->mes = "05";
        if ($mess == "Jun") $this->mes = "06";
        if ($mess == "Jul") $this->mes = "07";
        if ($mess == "Aug") $this->mes = "08";
        if ($mess == "Sep") $this->mes = "09";
        if ($mess == "Oct") $this->mes = "10";
        if ($mess == "Nov") $this->mes = "11";
        if ($mess == "Dec") $this->mes = "12";
    }

    public function total_mes()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        $_sql = 'select count(*) as total from log where month(data_hora) = ' . $mes . ' and year(data_hora) = ' . $ano;
        $_sql .= "   and not usuario in (" . $this->filtro_usuarios . ")";

        $reg = DB::select($_sql);
        $total = $reg[0]->total;

        if ($total == null)
            $total = 0;

        return $total;
    }

    // traz o percentual de usu�rios que usaram o sistema no m�s
    public function usuarios_mes()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        // define o totald e usu�rios que usaram o sistema no m�s
        $_sql = 'select count(distinct usuario) as total from log where month(data_hora) = ' . $mes . ' and year(data_hora) = ' . $ano;
        $_sql .= "   and not usuario in (" . $this->filtro_usuarios . ")";

        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        if ($total_mes == null)
            $total_mes = 0;

        // pega o total de usu�rios ativos ou que usaram o sistema no m�s
        $_sql = "select count(*) as total " .
            " from usuarios " .
            " where ( flag_ativo_usuario = 'S' " .
            " or ( login_usuario in ( select distinct usuario " .
            " from log " .
            " where month(data_hora) = " . $mes .
            " and year(data_hora) = " . $ano . " )))";
        $_sql .= "   and not login_usuario in (" . $this->filtro_usuarios . ")";

        $reg = DB::select($_sql);
        $total_usuarios = $reg[0]->total;

        if ($total_usuarios == null)
            $total_usuarios = 0;

        // calcula o percentual
        if (($total_usuarios == 0) or ($total_mes == 0))
            $perc = 0;
        else
            $perc = ($total_mes / $total_usuarios * 100);


        $cor_usuarios = "bg-green";
        $imagem_usuarios = "fa fa-thumbs-o-up";
        if ($perc < 50)   // se o n�mero for menor de 30% manda a cor amarela
            $cor_usuarios = "bg-yellow";
        if ($perc < 30) {  // se o n�mero for menor de 30% manda a cor vermelha
            $cor_usuarios = "bg-red";
            $imagem_usuarios = "fa fa-thumbs-o-down";
        }

        // formata o n�mero
        $percentual = number_format($perc, 2, ',', '');
        //return view('log.usuarios_mes', compact('percentual', 'cor_usuarios', 'imagem_usuarios'));
        return $percentual;
    }


    // traz o total de usu�rios �nicos no m�s
    public function usuarios_unicos()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        // define o totald e usu�rios que usaram o sistema no m�s
        $_sql = 'select count(distinct usuario) as total from log where month(data_hora) = ' . $mes . ' and year(data_hora) = ' . $ano;
        $_sql .= "   and not usuario in (" . $this->filtro_usuarios . ")";

        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        $_sql = "select count(distinct id_usuario) as total from usuarios where not login_usuario in (" . $this->filtro_usuarios . ")";
        $reg = DB::select($_sql);
        $total_usuarios = $reg[0]->total;

        /*
        return view('log.usuarios_unicos')
            ->with('total_mes', $total_mes)
            ->with('total_usuarios', $total_usuarios);
        */
        return $total_usuarios;
    }

    // traz o total de departamentos que utilizaram o sistema
    public function departamentos_unicos()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        // define o totald de departamentos que usaram o sistema no m�s
        $_sql = "select count(distinct b.id_departamento) as total " .
            " from log a left join usuarios      b on a.usuario = b.login_usuario " .
            " where month(a.data_hora) = " . $mes . " and year(a.data_hora) = " . $ano;
        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        $_sql = "select count(id_departamento) as total from departamentos";
        $reg = DB::select($_sql);
        $total_dep = $reg[0]->total;

        /*
        return view('log.departamentos_unicos')
            ->with('total_mes', $total_mes)
            ->with('total_depto', $total_dep);
         */
        return $total_dep;
    }


    // traz a lista de usu�rio com o total de acessos por m�s
    public function usuarios_acessos()
    {
        $usuarios = $this->usuarios_acessos_sql();
        $virg = "";

        for ($i = 0; $i < sizeof($usuarios); $i++) {
            $usuarios[$i]->nome_usuario = utf8_encode($usuarios[$i]->nome_usuario);
            $usuarios[$i]->login_usuario = utf8_encode($usuarios[$i]->login_usuario);
            $usuarios[$i]->departamento_descricao = utf8_encode($usuarios[$i]->departamento_descricao);
            $usuarios[$i]->virgula = $virg;


            $virg = ",";
        }
        return view('log.usuarios_acessos', compact('usuarios'));
    }

    public function usuarios_acessos_sql()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        $_sql = "select a.nome_usuario	";
        $_sql .= ", a.login_usuario ";
        $_sql .= ", c.departamento_descricao";
        $_sql .= ", sum( case when ( month(b.data_hora) = 1 ) then 1 else 0 end ) as janeiro";
        $_sql .= ", sum( case when ( month(b.data_hora) =  2 ) then 1 else 0 end ) as fevereiro";
        $_sql .= ", sum( case when ( month(b.data_hora) =  3 ) then 1 else 0 end ) as marco";
        $_sql .= ", sum( case when ( month(b.data_hora) =  4 ) then 1 else 0 end ) as abril";
        $_sql .= ", sum( case when ( month(b.data_hora) =  5 ) then 1 else 0 end ) as maio";
        $_sql .= ", sum( case when ( month(b.data_hora) =  6 ) then 1 else 0 end ) as junho";
        $_sql .= ", sum( case when ( month(b.data_hora) =  7 ) then 1 else 0 end ) as julho";
        $_sql .= ", sum( case when ( month(b.data_hora) =  8 ) then 1 else 0 end ) as agosto";
        $_sql .= ", sum( case when ( month(b.data_hora) =  9 ) then 1 else 0 end ) as setembro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 10 ) then 1 else 0 end ) as outubro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 11 ) then 1 else 0 end ) as novembro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 12 ) then 1 else 0 end ) as dezembro";
        $_sql .= " from usuarios	a";
        $_sql .= " inner join log b on a.login_usuario = b.usuario";
        $_sql .= " left  join departamentos c on a.id_departamento = c.id_departamento";
        $_sql .= " where year( b.data_hora ) = " . $ano;
        $_sql .= "   and not a.login_usuario in (" . $this->filtro_usuarios . ")";
        $_sql .= " group by a.nome_usuario";
        $_sql .= " , a.login_usuario";
        $_sql .= " , c.departamento_descricao";
        $_sql .= " order by a.nome_usuario";

        $usuarios = DB::select($_sql);

        // faz o acerto de utf
        $virg = " ";
        for ($i = 0; $i < sizeof($usuarios); $i++) {
            $usuarios[$i]->nome_usuario = utf8_encode($usuarios[$i]->nome_usuario);
            $usuarios[$i]->login_usuario = utf8_encode($usuarios[$i]->login_usuario);
            $usuarios[$i]->departamento_descricao = utf8_encode($usuarios[$i]->departamento_descricao);
            $usuarios[$i]->virgula = $virg;
            $virg = ",";

            $usuarios[$i]->janeiro = ($usuarios[$i]->janeiro == 0) ? "-" : $usuarios[$i]->janeiro;
            $usuarios[$i]->fevereiro = ($usuarios[$i]->fevereiro == 0) ? "-" : $usuarios[$i]->fevereiro;
            $usuarios[$i]->marco = ($usuarios[$i]->marco == 0) ? "-" : $usuarios[$i]->marco;
            $usuarios[$i]->abril = ($usuarios[$i]->abril == 0) ? "-" : $usuarios[$i]->abril;
            $usuarios[$i]->maio = ($usuarios[$i]->maio == 0) ? "-" : $usuarios[$i]->maio;
            $usuarios[$i]->junho = ($usuarios[$i]->junho == 0) ? "-" : $usuarios[$i]->junho;
            $usuarios[$i]->julho = ($usuarios[$i]->julho == 0) ? "-" : $usuarios[$i]->julho;
            $usuarios[$i]->agosto = ($usuarios[$i]->agosto == 0) ? "-" : $usuarios[$i]->agosto;
            $usuarios[$i]->setembro = ($usuarios[$i]->setembro == 0) ? "-" : $usuarios[$i]->setembro;
            $usuarios[$i]->outubro = ($usuarios[$i]->outubro == 0) ? "-" : $usuarios[$i]->outubro;
            $usuarios[$i]->novembro = ($usuarios[$i]->novembro == 0) ? "-" : $usuarios[$i]->novembro;
            $usuarios[$i]->dezembro = ($usuarios[$i]->novembro == 0) ? "-" : $usuarios[$i]->novembro;
        }
        return $usuarios;
    }

    // retorna a consulta no formato json
    public function usuarios_acessos_json()
    {
        $usuarios = $this->usuarios_acessos_sql();
        $usu['data'] = $usuarios;
        $usu_json = \Response::json($usu);
        return $usu_json;
    }

    // traz os dados para usar no gr�fico
    public function usuarios_acessos_g()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        $_sql = "select a.nome_usuario	";
        $_sql .= ", a.login_usuario ";
        $_sql .= ", c.departamento_descricao";
        $_sql .= ", count( b.data_hora ) as mes";
        $_sql .= " from usuarios	a";
        $_sql .= " inner join log b on a.login_usuario = b.usuario";
        $_sql .= " left  join departamentos c on a.id_departamento = c.id_departamento";
        $_sql .= " where year( b.data_hora ) = " . $ano;
        $_sql .= "   and month( b.data_hora ) = " . $mes;
        $_sql .= "   and not a.login_usuario in (" . $this->filtro_usuarios . ")";
        $_sql .= " group by a.nome_usuario";
        $_sql .= " , a.login_usuario";
        $_sql .= " , c.departamento_descricao";
        $_sql .= " having count( b.data_hora ) > 0";
        $_sql .= " order by a.nome_usuario";

        $usuarios = DB::select($_sql);
        $virg = "";

        for ($i = 0; $i < sizeof($usuarios); $i++) {
            $usuarios[$i]->nome_usuario = utf8_encode($usuarios[$i]->nome_usuario);
            $usuarios[$i]->login_usuario = utf8_encode($usuarios[$i]->login_usuario);
            $usuarios[$i]->departamento_descricao = utf8_encode($usuarios[$i]->departamento_descricao);
            $usuarios[$i]->virgula = $virg;
            $virg = ",";
        }
        return view('log.usuarios_acessos_g', compact('usuarios'));
    }

    // traz a lista de usu�rio com o total de acessos por m�s
    public function departamentos_acessos()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        $_sql = "select ";
        $_sql .= "  c.departamento_descricao";
        $_sql .= ", sum( case when ( month(b.data_hora) = 1 ) then 1 else 0 end ) as janeiro";
        $_sql .= ", sum( case when ( month(b.data_hora) =  2 ) then 1 else 0 end ) as fevereiro";
        $_sql .= ", sum( case when ( month(b.data_hora) =  3 ) then 1 else 0 end ) as marco";
        $_sql .= ", sum( case when ( month(b.data_hora) =  4 ) then 1 else 0 end ) as abril";
        $_sql .= ", sum( case when ( month(b.data_hora) =  5 ) then 1 else 0 end ) as maio";
        $_sql .= ", sum( case when ( month(b.data_hora) =  6 ) then 1 else 0 end ) as junho";
        $_sql .= ", sum( case when ( month(b.data_hora) =  7 ) then 1 else 0 end ) as julho";
        $_sql .= ", sum( case when ( month(b.data_hora) =  8 ) then 1 else 0 end ) as agosto";
        $_sql .= ", sum( case when ( month(b.data_hora) =  9 ) then 1 else 0 end ) as setembro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 10 ) then 1 else 0 end ) as outubro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 11 ) then 1 else 0 end ) as novembro";
        $_sql .= ", sum( case when ( month(b.data_hora) = 12 ) then 1 else 0 end ) as dezembro";
        $_sql .= " from usuarios	a";
        $_sql .= " inner join log b on a.login_usuario = b.usuario";
        $_sql .= " left  join departamentos c on a.id_departamento = c.id_departamento";
        $_sql .= " where year( b.data_hora ) = " . $ano;
        $_sql .= "   and not a.login_usuario in (" . $this->filtro_usuarios . ")";
        $_sql .= " group by ";
        $_sql .= "  c.departamento_descricao";
        $_sql .= " order by c.departamento_descricao";

        $usuarios = DB::select($_sql);

        for ($i = 0; $i < sizeof($usuarios); $i++) {
            $usuarios[$i]->departamento_descricao = utf8_encode($usuarios[$i]->departamento_descricao);
        }
        return view('log.departamentos_acessos', compact('usuarios'));
    }


    // controle de atletas
    public function atletas_chegaram()
    {
        $mes = $this->mes;
        $ano = $this->ano;

        $_sql = "SELECT 'TOTAL DE JOGADORES QUE CHEGARAM'	AS DESCRICAO ";
        $_sql = $_sql . " , COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM ELENCO A ";
        $_sql = $_sql . " WHERE MONTH( A.ELENCO_DT_CHEGADA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.ELENCO_DT_CHEGADA ) = " . $ano;
        $atletas_chegaram = DB::select($_sql);

        return $atletas_chegaram[0]->QTD;
    }

    public function atletas_sairam()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM ELENCO A ";
        $_sql = $_sql . " WHERE MONTH( A.ELENCO_DT_SAIDA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.ELENCO_DT_SAIDA ) = " . $ano;
        $atletas_sairam = DB::select($_sql);

        return $atletas_sairam[0]->QTD;
    }

    public function atletas_profissionais($id_categoria)
    {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM v_elenco A ";
        $_sql = $_sql . "  where elenco_status = 'S' ";
        $_sql = $_sql . "    and id_categoria  = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function atletas_dm($id_categoria)
    {
        $_sql = "SELECT COUNT( distinct id_departamento_medico) AS QTD ";
        $_sql = $_sql . "  FROM DEPARTAMENTO_MEDICO A ";
        $_sql = $_sql . "  LEFT JOIN V_ELENCO B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql = $_sql . " WHERE A.DM_DATA_FIM IS NULL ";
        $_sql = $_sql . "   AND A.FLAG_AFASTAMENTO = 'S'";
        $_sql = $_sql . "   AND B.ELENCO_STATUS = 'S' ";
        $_sql = $_sql . "   AND B.ID_CATEGORIA  = " . $id_categoria;
        $qry = DB::select($_sql);

        return $qry[0]->QTD;
    }

    public function atletas_grupoespecial($id_categoria)
    {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM v_elenco A ";
        $_sql = $_sql . "  where elenco_status = 'F' ";
        $_sql = $_sql . "    and id_categoria  = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function atletas_grupoemprestados($id_categoria)
    {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM v_elenco A ";
        $_sql = $_sql . "  where elenco_status = 'E' ";
        $_sql = $_sql . "    and id_categoria  = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function atletas_base()
    {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM v_elenco A ";
        $_sql = $_sql . "  where elenco_status = 'S' ";
        $_sql = $_sql . "    and id_categoria  in (3,4,5,6,7,8,9,10,11) ";
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // --- Alojamento
    public function alojamento_chegaram()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM CONTROLE_VAGAS A ";
        $_sql = $_sql . " WHERE MONTH( A.DATA_INICIAL ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.DATA_INICIAL ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function alojamento_sairam()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM CONTROLE_VAGAS A ";
        $_sql = $_sql . " WHERE MONTH( A.DATA_FINAL ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.DATA_FINAL ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // Serviço Social
    public function servsocial_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM ATENDIMENTO_ASSIST_SOCIAL A ";
        $_sql = $_sql . " WHERE MONTH( A.VISITA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.VISITA_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function servsocial_estudantes()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM JOGADOR_HIST_ESCOLAR A ";
        $_sql = $_sql . " WHERE ESCOLA_ANO = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // nutrição
    public function nutricao_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM ATENDIMENTO_NUTRICAO A ";
        $_sql = $_sql . " WHERE MONTH( A.ATENDIMENTO_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.ATENDIMENTO_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // psicologia
    public function psicologia_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM ATENDIMENTO_PSICOLOGIA A ";
        $_sql = $_sql . " WHERE MONTH( A.ATENDIMENTO_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.ATENDIMENTO_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }


    // DM
    public function dm_entradas()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM DEPARTAMENTO_MEDICO A ";
        $_sql = $_sql . " WHERE MONTH( A.DM_DATA_INICIO ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.DM_DATA_INICIO ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function dm_acompanhamentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM DEPARTAMENTO_MEDICO_ACOMPANHA A ";
        $_sql = $_sql . " WHERE MONTH( A.ACOMPANHAMENTO_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.ACOMPANHAMENTO_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function dm_cirurgias()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM DEPARTAMENTO_MEDICO_CIRURGIA A ";
        $_sql = $_sql . " WHERE MONTH( A.CIRURGIA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.CIRURGIA_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function dm_exames()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM DEPARTAMENTO_MEDICO_EXAME A ";
        $_sql = $_sql . " WHERE MONTH( A.EXAME_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.EXAME_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }


    // fisiologia - total de testes
    public function fisiologia_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT SUM(QTD) AS QTD ";
        $_sql = $_sql . " FROM ( ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIO_RESISTENCIA_CONTINUA A ";
        $_sql = $_sql . "  WHERE MONTH( A.RC_DATA ) = $mes AND  YEAR( A.RC_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIO_RESISTENCIA_INTERMITENTE A ";
        $_sql = $_sql . "  WHERE MONTH( A.RI_DATA ) = $mes AND  YEAR( A.RI_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIO_RESISTENCIA_VELOCIDADE A ";
        $_sql = $_sql . "  WHERE MONTH( A.RESIST_VELOC_DATA ) = $mes AND  YEAR( A.RESIST_VELOC_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIO_VELOC_CICLICA A ";
        $_sql = $_sql . "  WHERE MONTH( A.VELOC_CICLICA_DATA ) = $mes AND  YEAR( A.VELOC_CICLICA_DATA ) = $ano ";
        $_sql = $_sql . "  UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIO_YOYO A ";
        $_sql = $_sql . "  WHERE MONTH( A.YOYO_DATA ) = $mes AND  YEAR( A.YOYO_DATA ) = $ano ";
        $_sql = $_sql . "  UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIOLOGIA_ACELERACAO A ";
        $_sql = $_sql . "  WHERE MONTH( A.FIS_DATA ) = $mes AND  YEAR( A.FIS_DATA ) = $ano ";
        $_sql = $_sql . "  UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FISIOLOGIA_ANTROPO A ";
        $_sql = $_sql . "  WHERE MONTH( A.FIS_DATA ) = $mes AND  YEAR( A.FIS_DATA ) = $ano ";
        $_sql = $_sql . "  UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD";
        $_sql = $_sql . "  FROM FISIOLOGIA_IMPULSAO_VERTICAL A ";
        $_sql = $_sql . " WHERE MONTH( A.FIS_DATA ) = $mes AND  YEAR( A.FIS_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . " FROM FISIOLOGIA_LIMIAR A ";
        $_sql = $_sql . " WHERE MONTH( A.FISIOLOGIA_DATA ) = $mes AND  YEAR( A.FISIOLOGIA_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM FISIOLOGIA_MORFO A ";
        $_sql = $_sql . " WHERE MONTH( A.FISIOLOGIA_DATA ) = $mes AND  YEAR( A.FISIOLOGIA_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . " FROM FSL_ERGOESPIROMETRIA A ";
        $_sql = $_sql . " WHERE MONTH( A.ERGO_DATA ) = $mes AND  YEAR( A.ERGO_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . " FROM FSL_FLEXIBILIDADE A ";
        $_sql = $_sql . " WHERE MONTH( A.FLEX_DATA ) = $mes AND  YEAR( A.FLEX_DATA ) = $ano ";
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FSL_ISOCINETICO A ";
        $_sql = $_sql . "  WHERE MONTH( A.ISOC_DATA ) = $mes AND  YEAR( A.ISOC_DATA ) = $ano ";
        $_sql = $_sql . "  UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . " FROM FSL_SOCCER_TEST A ";
        $_sql = $_sql . " WHERE MONTH( A.SOCCER_DATA ) = $mes AND  YEAR( A.SOCCER_DATA ) = $ano ";
        $_sql = $_sql . " ) X ";
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // fisioterapia
    public function fisioterapia_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(B.ID_JOGADOR) AS QTD ";
        $_sql = $_sql . "  FROM FISIOTERAPIA_DIARIO A ";
        $_sql = $_sql . "  LEFT JOIN FISIOTERAPIA_JOGADORES B ON A.ID_FISIOTERAPIA = B.ID_FISIOTERAPIA ";
        $_sql = $_sql . " WHERE MONTH( A.FISIOTERAPIA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.FISIOTERAPIA_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // entrevistas
    public function entrevistas_total()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT SUM(QTD) AS QTD ";
        $_sql = $_sql . " FROM ( ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM JOGADOR_ENTREVISTA A ";
        $_sql = $_sql . "  WHERE MONTH( A.DAT_ENTREVISTA ) = " . $mes;
        $_sql = $_sql . "    AND YEAR ( A.DAT_ENTREVISTA ) = " . $ano;
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM MATERIAS A ";
        $_sql = $_sql . "  WHERE MONTH( A.MATERIA_DATA ) = " . $mes;
        $_sql = $_sql . "    AND YEAR ( A.MATERIA_DATA ) = " . $ano;
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FUNCIONARIO_ENTREVISTA A ";
        $_sql = $_sql . "  WHERE MONTH( A.DAT_ENTREVISTA ) = " . $mes;
        $_sql = $_sql . "    AND YEAR ( A.DAT_ENTREVISTA ) = " . $ano;
        $_sql = $_sql . " UNION ALL ";
        $_sql = $_sql . " SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "   FROM FUNCIONARIO_ENTREVISTA A ";
        $_sql = $_sql . "  WHERE MONTH( A.DAT_ENTREVISTA ) = " . $mes;
        $_sql = $_sql . "    AND YEAR ( A.DAT_ENTREVISTA ) = " . $ano;
        $_sql = $_sql . " ) A ";
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // administrativos
    public function adm_mudancasCategoria()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM JOGADOR_MUDANCA_CATEGORIA A ";
        $_sql = $_sql . " WHERE MONTH( A.MUDANCA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.MUDANCA_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function adm_ocorrencias()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM JOGADOR_OCORRENCIA A ";
        $_sql = $_sql . " WHERE MONTH( A.OCORR_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.OCORR_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // funcionários
    public function funcionarios_qtd()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM FUNCIONARIOS A ";
        $_sql = $_sql . " WHERE MONTH( A.FUNC_DATA_ENTRADA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.FUNC_DATA_ENTRADA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }


    // preparação física
    public function prepfisica_atendimentos()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM PREP_FISICA_PREVISTA A ";
        $_sql = $_sql . " WHERE MONTH( A.PREP_FISICA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.PREP_FISICA_DATA ) = " . $ano;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function prepfisica_jogadores()
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM PREP_FISICA_ELENCO A ";
        $_sql = $_sql . " WHERE MONTH( A.PREP_FISICA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.PREP_FISICA_DATA ) = " . $ano;
        $_sql = $_sql . "   AND A.ID_MOTIVO_FALTA IS NULL ";
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    // quadro de atividades
    public function qts_total($id_categoria)
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(DISTINCT QUADRO_ATIVIDADE_DATA) AS QTD ";
        $_sql = $_sql . "  FROM QUADRO_ATIVIDADES A ";
        $_sql = $_sql . " WHERE MONTH( A.QUADRO_ATIVIDADE_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.QUADRO_ATIVIDADE_DATA ) = " . $ano;
        $_sql = $_sql . "   AND A.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function qts_hoje($id_categoria, $data)
    {
        $mes = date('Y', $data);
        $ano = date('m', $data);
        $dia = date('d', $data);

        $_sql = "SELECT * ";
        $_sql = $_sql . "  FROM QUADRO_ATIVIDADES A ";
        $_sql = $_sql . " WHERE MONTH( A.QUADRO_ATIVIDADE_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.QUADRO_ATIVIDADE_DATA ) = " . $ano;
        $_sql = $_sql . "   AND DAY  ( A.QUADRO_ATIVIDADE_DATA ) = " . $dia;
        $_sql = $_sql . "   AND A.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function jogos_total($id_categoria)
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM TABELA A ";
        $_sql = $_sql . "   INNER JOIN CAMPEONATO B ON A.ID_CAMPEONATO = B.ID_CAMPEONATO ";
        $_sql = $_sql . " WHERE MONTH( A.PARTIDA_DATA ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.PARTIDA_DATA ) = " . $ano;
        $_sql = $_sql . "   AND B.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function viagens_total($id_categoria)
    {
        $mes = $this->mes;
        $ano = $this->ano;
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql = $_sql . "  FROM VIAGEM A ";
        $_sql = $_sql . " WHERE MONTH( A.VIAGEM_DATA_INICIO ) = " . $mes;
        $_sql = $_sql . "   AND YEAR ( A.VIAGEM_DATA_INICIO ) = " . $ano;
        $_sql = $_sql . "   AND A.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }


    // avisos na parte de cima
    public function avisos_ocorrencias($id_categoria) {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql .= "  FROM JOGADOR_OCORRENCIA A ";
        $_sql .= " WHERE ( A.OCORR_DATA = GETDATE() ) ";
        //$_sql = $_sql . "   AND A.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);


        $_sql = "select TOP 10 ";
        $_sql .= "  A.OCORR_DESCRICAO ";
        $_sql .= ", A.OCORR_DATA ";
        $_sql .= ", B.JOG_NOME_APELIDO ";
        $_sql .= ", A.OCORR_TIPO ";
        $_sql .= " from JOGADOR_OCORRENCIA A INNER JOIN JOGADORES B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql .= " where A.OCORR_TIPO > 0 ";
        $_sql .= " order by A.OCORR_DATA ";
        $_SESSION['ocorrencias'] = DB::select($_sql);

        //return(dd($_SESSION['ocorrencias']));
        $_SESSION['avisos_ocorrencias'] = $qry[0]->QTD;
        return $qry[0]->QTD;
    }
}



