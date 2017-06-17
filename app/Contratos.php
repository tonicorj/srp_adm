<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Contratos extends Model
{
    protected $fillable = ['id_contrato', 'cont_dt_inicio', 'cont_dt_final', 'id_jogador'];
    protected $primaryKey = 'id_contrato';

    /**
     * retorna o valor total de contratos por mês
     * @return mixed
     */
    public function contratos_total_mes()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;

        $_sql = "SELECT ";
        $_sql .= " MES = MONTH( A.CONT_DT_PAGAMENTO ) ";
        $_sql .= " ,T_CONT_VL_SALARIO			= SUM( A.CONT_VL_SALARIO ) ";
        $_sql .= " ,T_CONT_VL_DIREITO_IMAGEM	= SUM( A.CONT_VL_DIREITO_IMAGEM	) ";
        $_sql .= " ,T_CONT_VL_LUVAS            = SUM( A.CONT_VL_LUVAS ) ";
        $_sql .= "   FROM CONTRATOS_PAGAMENTOS2 A ";
        $_sql .= "   INNER JOIN ELENCO          B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql .= "  WHERE YEAR( A.CONT_DT_PAGAMENTO ) = " . $ano;
        $_sql .= "    AND B.ELENCO_STATUS <> 'N' ";
        $_sql .= "    AND B.ID_CATEGORIA = " . $id_categoria ;
        $_sql .= "  GROUP BY MONTH( CONT_DT_PAGAMENTO ) ";
        $_sql .= "  ORDER BY MONTH( CONT_DT_PAGAMENTO ) ";

        $reg = DB::select($_sql);
        //return dd($reg);
        return $reg;

        /*
        $avisos = new Dashboard;
        return view('dashboard.index')
            ->with('db', $dashboard)
            ->with('avisos', $avisos->avisos($id_categoria));
        */
    }

    /**
     * exibe os dados do contrato
     */
    public function show($id) {

        $sql = "select a.* ";
        $sql .= " , b.jog_nome_apelido ";
        $sql .= " , b.jog_nome_completo ";
        $sql .= " , b.jog_dt_nascimento ";
        $sql .= " , b.jog_cbf ";
        $sql .= " , c.relacao_nome ";
        $sql .= " , d.time_nome ";
        $sql .= " , e.TIPO_CONTRATO_DESCRICAO ";
        $sql .= " , f.jogador_foto ";
        $sql .= " , p.POSICAO_DESCRICAO ";
        $sql .= " , b.JOG_IDADE ";
        $sql .= " , h.CATEG_DESCRICAO ";
        $sql .= " from contratos        a ";
        $sql .= " left join jogadores     b on a.id_jogador              = b.id_jogador ";
        $sql .= " left join relacao       c on a.id_relacao              = c.id_relacao ";
        $sql .= " left join v_time        d on a.id_time_dir_federativos = d.id_time ";
        $sql .= " left join TIPO_CONTRATO e on a.id_tipo_contrato        = e.ID_TIPO_CONTRATO ";
        $sql .= " left join jogador_foto  f on a.id_jogador              = f.id_jogador ";
        $sql .= " left join x_elenco      g on a.id_jogador              = g.id_jogador ";
        $sql .= " left join categorias    h on g.id_categoria            = h.id_categoria ";
        $sql .= " left join POSICAO		    p on b.JOG_POSICAO			 = p.POSICAO ";
        $sql .= "WHERE A.ID_CONTRATO = " . $id;
        $reg = DB::select($sql);

        $avisos = new Dashboard;

        return view('contratos.show')
            ->with('contrato', $reg)
            ->with('avisos', $avisos->avisos(Auth::user()->categoria_selecionada()));
    }


    public static function contratos_vlr_simples()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;
        $mes = Auth::user()['config']->mes;

        $_sql = "SELECT ";
        $_sql .= "  T_VL_SIMPLES = SUM( A.CONT_VL_SALARIO ) + SUM( A.CONT_VL_DIREITO_IMAGEM	) ";
        $_sql .= "   FROM CONTRATOS_PAGAMENTOS2 A ";
        $_sql .= "   INNER JOIN ELENCO          B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql .= "  WHERE YEAR (A.CONT_DT_PAGAMENTO) = " . $ano;
        $_sql .= "    AND MONTH(A.CONT_DT_PAGAMENTO) = " . $mes;
        $_sql .= "    AND B.ELENCO_STATUS <> 'N' ";
        $_sql .= "    AND B.ID_CATEGORIA = " . $id_categoria ;
        $reg = DB::select($_sql);
        //return dd($reg);
        return $reg;
    }

    public static function contratos_vlr_produtividade() {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;
        $mes = Auth::user()['config']->mes;

        $diaIni = '01';
        $diaFinal = '31';

        if ($mes == 2) {
            $diaFinal = '28';
        }
        if (($mes == 4) || ($mes == 6) || ($mes == 9) || ($mes == 11)) {
            $diaFinal = '30';
        }
        $dataIni = $ano . $mes . $diaIni;
        $dataFinal = $ano . $mes . $diaFinal;

        //$dataIni = $ano . '0201';
        //$dataFinal = $ano . '0228';

        $_sql  = " select ";
        $_sql .= " SUM( aumento_valor ) as T_VL_PRODUTIVIDADE ";
        $_sql .= " from F_JOGADORES_PRODUTIVIDADE_PERIODO( '" . $dataIni . "','" . $dataFinal . "' ) x ";
        $_sql .= " left join jogadores  c on x.id_jogador   = c.id_jogador ";
        $_sql .= " left join x_elenco   a on x.id_jogador   = a.id_jogador ";
        $_sql .= "left join categorias e on a.id_categoria = e.id_categoria ";
        $_sql .= "where (x.id_categoria = " . $id_categoria . " ) ";
        $reg = DB::select($_sql);
        //return dd($reg);
        return $reg;
    }

    public static function contratos_vlr_total(){
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;
        $mes = Auth::user()['config']->mes;

        $_sql = "select T_VL_TOTAL = sum( vl_total ) ";
        $_sql .= " from F_CONTRATOS_ATIVOS( " . $ano . "," . $mes . ") a";
        $_sql .= " left join posicao b on a.jog_posicao = b.posicao ";
        $_sql .= " where a.id_categoria = " . $id_categoria;
        $_sql .= "and (a.elenco_status in ('S','E'))";
        $reg = DB::select($_sql);
        //return dd($reg);
        return $reg;
    }

}
