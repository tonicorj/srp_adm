<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Categorias;

use DB;
use App\Dashboard;
use Illuminate\Support\Facades\Auth;


class CategoriasController extends Controller
{

    // total de jogadores por categoria
    public function jogadores () {
        $_sql = "select ";
        $_sql .= "  a.categ_descricao ";
        $_sql .= " ,a.categ_idade_ini ";
        $_sql .= " ,sum( case when b.elenco_status = 'S' then 1 else 0 end ) as ativos ";
        $_sql .= " ,sum( case when b.elenco_status = 'E' then 1 else 0 end ) as emprestados ";
        $_sql .= " ,sum( case when b.elenco_status = 'F' then 1 else 0 end ) as grupo_especial ";
        $_sql .= " ,count( b.id_jogador ) as total_jog ";
        $_sql .= " from categorias a left join ( select * from elenco where ( elenco_status <> 'N' ) ) b on a.id_categoria = b.id_categoria ";
        $_sql .= " group by  ";
        $_sql .= " a.categ_descricao ";
        $_sql .= " ,a.categ_idade_ini ";
        $_sql .= " order by a.categ_idade_ini, a.categ_descricao desc";

        $categorias = DB::select($_sql);
        $avisos = new Dashboard;
        return view( 'categorias.jogadores')
            ->with('categorias', $categorias)
            ->with('avisos', $avisos->avisos(1));
    }

    public function contratos() {
        $_sql = "select";
        $_sql .= " '02-Contratos por categoria' as titulo";
        $_sql .= " , a.categ_descricao ";
        $_sql .= " , a.categ_idade_ini ";
        $_sql .= " , count (x.id_jogador) as qtd ";
        $_sql .= " from categorias a left join ( ";
        $_sql .= " select distinct ";
        $_sql .= "   a.id_jogador ";
        $_sql .= " , b.jog_nome_apelido ";
        $_sql .= " , b.jog_nome_completo ";
        $_sql .= " , c.id_categoria ";
        $_sql .= " from jogador_contratos a ";
        $_sql .= " inner join jogadores  b on a.id_jogador   = b.id_jogador ";
        $_sql .= " inner join elenco     c on b.id_jogador   = c.id_jogador ";
        $_sql .= " ) x on a.id_categoria = x.id_categoria ";
        $_sql .= " group by a.categ_idade_ini, a.categ_descricao ";
        $_sql .= " order by a.categ_idade_ini, a.categ_descricao desc";

        $categorias = DB::select($_sql);
        return view( 'categorias.contratos')
            ->with('categorias', $categorias);
    }

    public function contratos_g() {
        $_sql = "select ";
        $_sql.= "   a.categ_descricao ";
        $_sql.= " , a.categ_idade_ini ";
        $_sql.= " , count (x.id_jogador) as qtd_contrato ";
        $_sql.= " , max( w.qtd )         as qtd_jogadores ";
        $_sql.= " from categorias a  ";
        $_sql.= " left join ( ";
        $_sql.= "			 select distinct ";
        $_sql.= "			   a.id_jogador ";
        $_sql.= "			 , b.jog_nome_apelido ";
        $_sql.= "			 , b.jog_nome_completo ";
        $_sql.= "			 , c.id_categoria ";
        $_sql.= "			 from jogador_contratos a ";
        $_sql.= "			 inner join jogadores  b on a.id_jogador   = b.id_jogador ";
        $_sql.= "			 inner join elenco     c on b.id_jogador   = c.id_jogador ";
        $_sql.= "		   ) x on a.id_categoria = x.id_categoria ";
        $_sql.= " left join ( select id_categoria, count(id_jogador) as qtd ";
        $_sql.= "               from elenco ";
        $_sql.= "			  where elenco_status <> 'N' ";
        $_sql.= "			  group by id_categoria ";
        $_sql.= "		   ) w on a.id_categoria = w.id_categoria ";
        $_sql.= " where a.categ_idade_ini >= 16 ";
        $_sql.= " group by a.categ_idade_ini, a.categ_descricao ";
        $_sql.= " order by a.categ_idade_ini, a.categ_descricao desc ";

        $categorias = DB::select($_sql);

        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);

            if (is_null($categorias[$i]->qtd_jogadores) == true)
                $categorias[$i]->qtd_jogadores = 0;

            if ( $categorias[$i]->qtd_contrato > 0)
                $categorias[$i]->percentual = round($categorias[$i]->qtd_contrato / $categorias[$i]->qtd_jogadores * 100);
            else
               $categorias[$i]->percentual = 0;

            if ($i == 0) $categorias[$i]->cor = 'progress-bar-aqua';
            if ($i == 1) $categorias[$i]->cor = 'progress-bar-yellow';
            if ($i == 2) $categorias[$i]->cor = 'progress-bar-red';
            if ($i == 3) $categorias[$i]->cor = 'progress-bar-green';
            if ($i == 4) $categorias[$i]->cor = 'progress-bar-yellow';
        }

        //return dd($categorias);
        return view( 'categorias.contratos_g')
            ->with('categorias', $categorias);
    }

    public function dm_mes() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= "   b.categ_idade_ini";
        $_sql .= " , b.categ_descricao";
        $_sql .= " , count( a.dm_data_inicio ) as total";
        $_sql .= " from categorias b left join ";
        $_sql .= " ( select * from DEPARTAMENTO_MEDICO ";
        $_sql .= " where year ( dm_data_inicio ) = " . $ano;
        $_sql .= "   and month( dm_data_inicio ) = " . $mes;
        $_sql .= " ) A on b.id_categoria = a.id_categoria";
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);
        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.dm_mes')
            ->with('categorias', $categorias);
    }

    public function dm_ano(){
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= " '2-Entradas no DM por categoria' as titulo";
        $_sql .= " , b.categ_idade_ini";
        $_sql .= " , b.categ_descricao";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 1 then 1 else 0 end ) as janeiro";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 2 then 1 else 0 end ) as fevereiro";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 3 then 1 else 0 end ) as marco";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 4 then 1 else 0 end ) as abril";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 5 then 1 else 0 end ) as maio";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 6 then 1 else 0 end ) as junho";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 7 then 1 else 0 end ) as julho";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 8 then 1 else 0 end ) as agosto";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 9 then 1 else 0 end ) as setembro";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 10 then 1 else 0 end ) as outubro";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 11 then 1 else 0 end ) as novembro";
        $_sql .= " , sum( case when month( a .dm_data_inicio ) = 12 then 1 else 0 end ) as dezembro";
        $_sql .= " from DEPARTAMENTO_MEDICO A inner join categorias b on a.id_categoria = b . id_categoria";
        $_sql .= " where year ( a .dm_data_inicio ) = " . $ano;
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);
        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.dm_ano')
            ->with('categorias', $categorias);
    }

    public function ocorrencias() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= " '3-Ocorrencias por categoria' as titulo";
        $_sql .= " , b.categ_descricao ";
        $_sql .= " , count(a.id_jogador) as total ";
        $_sql .= " from categorias b left join ";
        $_sql .= " ( select *  ";
        $_sql .= "     from jogador_ocorrencia ";
        $_sql .= "    where month( ocorr_data) = " . $mes ;
        $_sql .= "      and year ( ocorr_data ) = " . $ano;
        $_sql .= ") a on b.id_categoria = a.id_categoria ";
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao ";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);
        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.ocorrencias')
            ->with('categorias', $categorias);
    }

    public function concentracoes() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= "   b.categ_descricao ";
        $_sql .= " , count(a.id_viagem) as total ";
        $_sql .= " from categorias b left join ";
        $_sql .= " ( select *  ";
        $_sql .= "     from viagem ";
        $_sql .= "    where month( viagem_data_inicio ) = " . $mes ;
        $_sql .= "      and year ( viagem_data_inicio ) = " . $ano;
        $_sql .= ") a on b.id_categoria = a.id_categoria ";
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao ";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);
        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.concentracoes')
            ->with('categorias', $categorias);
    }

    public function qts() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= "   b.categ_descricao ";
        $_sql .= " , count(distinct a.quadro_atividade_data) as total ";
        $_sql .= " from categorias b left join ";
        $_sql .= " ( select *  ";
        $_sql .= "     from quadro_atividades ";
        $_sql .= "    where month(quadro_atividade_data) = " . $mes ;
        $_sql .= "      and year (quadro_atividade_data) = " . $ano;
        $_sql .= ") a on b.id_categoria = a.id_categoria ";
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao ";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);
        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.qts')
            ->with('categorias', $categorias);
    }

    public function prep_fisica(){
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select";
        $_sql .= "   b.categ_descricao ";
        $_sql .= " , count(distinct a.prep_fisica_data) as total ";
        $_sql .= " from categorias b left join ";
        $_sql .= " ( select *  ";
        $_sql .= "     from prep_fisica_prevista ";
        $_sql .= "    where month(prep_fisica_data) = " . $mes ;
        $_sql .= "      and year (prep_fisica_data) = " . $ano;
        $_sql .= ") a on b.id_categoria = a.id_categoria ";
        $_sql .= " group by b.categ_idade_ini, b.categ_descricao ";
        $_sql .= " order by b.categ_idade_ini, b.categ_descricao desc";

        $categorias = DB::select($_sql);

        for ( $i =  0; $i < sizeof( $categorias ); $i++ ) {
            $categorias[$i]->categ_descricao = utf8_encode($categorias[$i]->categ_descricao);
        }

        return view( 'categorias.prep_fisica')
            ->with('categorias', $categorias);
    }


    public function jogos() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select ";
        $_sql .= " '10-Jogos' as titulo ";
        $_sql .= " , c.categ_descricao ";
        $_sql .= " , count( distinct x.id_jogo)	as qtd ";
        $_sql .= " from categorias C left join( ";
        $_sql .= " select e.id_categoria, d.partida_data, d.id_jogo ";
        $_sql .= "   from CAMPEONATO  E ";
        $_sql .= "   left join TABELA D ON E.ID_CAMPEONATO = D.ID_CAMPEONATO ";
        $_sql .= " where month(d.partida_data) = " . $mes;
        $_sql .= "   and year (d.partida_data) = " . $ano;
        $_sql .= " ) x on c.id_categoria = x.id_categoria ";
        $_sql .= " group by c.categ_idade_ini, c.categ_descricao ";
        $_sql .= " order by c.categ_idade_ini, c.categ_descricao desc";

        $categorias = DB::select($_sql);
        return view( 'categorias.jogos')
            ->with('categorias', $categorias);
    }

    public function jogos_jogadores() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select ";
        $_sql .= " '10-Jogos x Jogadores' as titulo ";
        $_sql .= " , c.categ_descricao ";
        $_sql .= " , count( distinct x.id_jogador )	as qtd ";
        $_sql .= " from categorias C left join( ";
        $_sql .= " select e.id_categoria, d.partida_data, a.id_jogador ";
        $_sql .= " from PARTIDAJOGADORES a ";
        $_sql .= " left join V_ELENCO   B on a.id_jogador    = b.id_jogador ";
        $_sql .= " LEFT JOIN CAMPEONATO E ON A.ID_CAMPEONATO = E.ID_CAMPEONATO ";
        $_sql .= " LEFT JOIN TABELA     D ON A.ID_CAMPEONATO = D.ID_CAMPEONATO AND a.ID_JOGO = D.ID_JOGO ";
        $_sql .= " where month(d.partida_data) = " . $mes;
        $_sql .= "   and year (d.partida_data ) = " . $ano;
        $_sql .= " ) x on c.id_categoria = x.id_categoria ";
        $_sql .= " group by c.categ_idade_ini, c.categ_descricao ";
        $_sql .= " order by c.categ_idade_ini, c.categ_descricao desc";

        $categorias = DB::select($_sql);
        return view( 'categorias.jogos_jogadores')
            ->with('categorias', $categorias);
    }

    public function assistencia_social() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select count(id_ativ_assist_social ) as total ";
        $_sql .= " from FREQUENCIA_ASSIST_SOCIAL a ";
        $_sql .= " where month(visita_data) = " . $mes ;
        $_sql .= "   and year(visita_data) =  " . $ano ;

        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        $cor_ = "bg-aqua";
        if ( $total_mes < 20 )   // se o número for menor de 30% manda a cor amarela
            $cor_ = "bg-yellow";
        if ( $total_mes < 10 )   // se o número for menor de 30% manda a cor vermelha
            $cor_ = "bg-red";

        return view( 'categorias.assistencia_social')
            ->with('total_mes', $total_mes)
            ->with('cor_assist', $cor_)
            ;
    }

    public function pedagogia() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select count(visita_data ) as total ";
        $_sql .= " from FREQUENCIA_PEDAGOGICA a ";
        $_sql .= " where month(visita_data) = " . $mes ;
        $_sql .= "   and year(visita_data) =  " . $ano ;

        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        $cor_ = "bg-aqua";
        if ( $total_mes < 20 )   // se o número for menor de 30% manda a cor amarela
            $cor_ = "bg-yellow";
        if ( $total_mes < 10 )   // se o número for menor de 30% manda a cor vermelha
            $cor_ = "bg-red";

        return view( 'categorias.pedagogia')
            ->with('total_mes', $total_mes)
            ->with('cor_assist', $cor_)
            ;
    }

    public function fisioterapia() {
        $mes = Auth::user()['config']->mes;
        $ano = Auth::user()['config']->ano;

        $_sql = " select count(ID_JOGADOR) as total ";
        $_sql .= " from FISIOTERAPIA_JOGADORES_TRATAMENTO a left join FISIOTERAPIA_DIARIO b on A.ID_FISIOTERAPIA = B.ID_FISIOTERAPIA ";
        $_sql .= " where month(fisioterapia_data) = " . $mes ;
        $_sql .= "   and year(fisioterapia_data) =  " . $ano ;

        $reg = DB::select($_sql);
        $total_mes = $reg[0]->total;

        $cor_ = "bg-aqua";
        if ( $total_mes < 20 )   // se o número for menor de 20% manda a cor amarela
            $cor_ = "bg-yellow";
        if ( $total_mes < 10 )   // se o número for menor de 10% manda a cor vermelha
            $cor_ = "bg-red";

        return view( 'categorias.fisioterapia')
            ->with('total_mes', $total_mes)
            ->with('cor_assist', $cor_)
            ;
    }

}
