<?php
/*
 * Created by PhpStorm.
 * User: Tonico
 * Date: 04/06/2016
 * Time: 20:45
 * Diversas Funcoes
 */


/**
 * Checks date if matches given format and validity of the date.
 * Examples:
 * <code>
 * is_date('22.22.2222', 'mm.dd.yyyy'); // returns false
 * is_date('11/30/2008', 'mm/dd/yyyy'); // returns true
 * is_date('30-01-2008', 'dd-mm-yyyy'); // returns true
 * is_date('2008 01 30', 'yyyy mm dd'); // returns true
 * </code>
 * @param string $value the variable being evaluated.
 * @param string $format Format of the date. Any combination of <i>mm<i>, <i>dd<i>, <i>yyyy<i>
 * with single character separator between.
 */
use Carbon\Carbon;
//use DB;
//use Illuminate\Support\Facades\DB;

function is_valid_date($value, $format = 'dd.mm.yyyy'){
    Config::set('app.timezone', 'America/Sao_Paulo');
    if(strlen($value) >= 6 && strlen($format) == 10){

        // find separator. Remove all other characters from $format
        $separator_only = str_replace(array('m','d','y'),'', $format);
        $separator = $separator_only[0]; // separator is first character

        if($separator && strlen($separator_only) == 2){
            // make regex
            $regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
            $regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
            $regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
            $regexp = str_replace($separator, "\\" . $separator, $regexp);
            if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){

                // check date
                $arr=explode($separator,$value);
                $day=$arr[0];
                $month=$arr[1];
                $year=$arr[2];
                //if(@checkdate($month, $day, $year))
                if(@checkdate($day, $month, $year))
                    return true;
            }
        }
    }

    return false;
}

function data_to_sql( $data ) {
    if ($data=='') {
        $resultado = null;
    }
    else {

        if ( strpos($data, '-') == 2 ) {
            $dia = substr($data, 0, 2);
            $mes = substr($data, 3, 2);
            $ano = substr($data, 5, 4);
        }
        else if ( strpos($data, '-') == 4 ) {
            $dia = substr($data, 8, 2);
            $mes = substr($data, 5, 2);
            $ano = substr($data, 0, 4);
        }
        else {
            $dia = substr($data, 0, 2);
            $mes = substr($data, 3, 2);
            $ano = substr($data, 6, 4);
        }
        //$resultado = "CONVERT( DATETIME, '" . $ano . $mes . $dia . "')";
        //$resultado = "'" . $ano . $mes . $dia . "'";
        //$resultado = "'" . $ano . '-' . $mes . '-' . $dia . ' 00:00:00.000' . "'";
        $resultado = Carbon::create($ano, $mes, $dia)->setTime(0,0,0)->format('Ymd');
    }
    return $resultado;
}

function data_to_query( $data ) {
    if ($data=='') {
        $resultado = null;
    }
    else {

        if ( strpos($data, '-') == 2 ) {
            $dia = substr($data, 0, 2);
            $mes = substr($data, 3, 2);
            $ano = substr($data, 5, 4);
        }
        else if ( strpos($data, '-') == 4 ) {
            $dia = substr($data, 8, 2);
            $mes = substr($data, 5, 2);
            $ano = substr($data, 0, 4);
        }
        else {
            $dia = substr($data, 0, 2);
            $mes = substr($data, 3, 2);
            $ano = substr($data, 6, 4);
        }
        //$resultado = "CONVERT( DATETIME, '" . $ano . $mes . $dia . "')";
        $resultado = "'" . $ano . $mes . $dia . "'";
    }
    return $resultado;
}

function data_display( $data ) {

    // retira o acento
    $data = str_replace( "'", "", $data);

    if ($data=='') {
        $resultado = '';
    }
    else {
        $dia = "00";
        $mes = "00";
        $ano = "0000";

        if ( strlen($data) >= 19 ) {
            //$mes = substr ($data, 1, 2);
            //$dia = substr ($data, 5, 2);
            //$ano = substr ($data, 8, 5);

            $mes = substr ($data, 5, 2);
            $dia = substr ($data, 8, 2);
            $ano = substr ($data, 0, 4);

            // define o m?s
            if ($mes == 'Jan') $mes = '01';
            if ($mes == 'Feb') $mes = '02';
            if ($mes == 'Mar') $mes = '03';
            if ($mes == 'Apr') $mes = '04';
            if ($mes == 'May') $mes = '05';
            if ($mes == 'Jun') $mes = '06';
            if ($mes == 'Jul') $mes = '07';
            if ($mes == 'Aug') $mes = '08';
            if ($mes == 'Sep') $mes = '09';
            if ($mes == 'Oct') $mes = '10';
            if ($mes == 'Nov') $mes = '11';
            if ($mes == 'Dec') $mes = '12';

            // retira os espa?os
            $dia = trim($dia);
            $ano = trim($ano);
            //$ano = $ano . ' - ' . $data;
        }
        else if ( (strlen($data) == 10) || (strlen($data) == 23)) {

            if ( strpos($data, '-') == 4 ) {
                $dia = substr($data, 8, 2);
                $mes = substr($data, 5, 2);
                $ano = substr($data, 0, 4);
            }

            if ( strpos($data, '-') == 2 ) {
                $dia = substr($data, 0, 2);
                $mes = substr($data, 3, 2);
                $ano = substr($data, 5, 4);
            }

            if ( strpos($data, '/') == 4 ) {
                $dia = substr($data, 8, 2);
                $mes = substr($data, 5, 2);
                $ano = substr($data, 0, 4);
            }

            if ( strpos($data, '/') == 2 ) {
                $dia = substr($data, 0, 2);
                $mes = substr($data, 3, 2);
                $ano = substr($data, 5, 4);
            }
        }
        else if (strlen($data) == 8) {
            $dia = substr($data, 6, 2);
            $mes = substr($data, 4, 2);
            $ano = substr($data, 0, 4);
        }
        else {
            $dia = $data;
            $mes = '';
            $ano = '';
        }

        $resultado = $dia . '/' . $mes . '/' . $ano;
    }
    return $resultado;
}


function PesquisaFK( $fk_name )
{
    $registros = DB::table('INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS')
        ->select(DB::raw('count(*) as fk'))
        ->where('constraint_name', $fk_name)
        ->get();

    $reg = $registros[0];

    //return dd($reg->fk);

    if ($reg->fk == "0") {
        return false;
    } else {
        return true;
    }
}

function DiaInicioSemana ($data)
{
    $dia_da_semana = jddayofweek($data);
    $resultado     = $data;

    if ($dia_da_semana == 0)
        $resultado = date_add($resultado, -6);
    if ($dia_da_semana == 2)
        $resultado = date_add($resultado, -1);
    if ($dia_da_semana == 3)
        $resultado = date_add($resultado, -2);
    if ($dia_da_semana == 4)
        $resultado = date_add($resultado, -3);
    if ($dia_da_semana == 5)
        $resultado = date_add($resultado, -4);
    if ($dia_da_semana == 6)
        $resultado = date_add($resultado, -5);

    return $resultado;
}

/* pega o valor de próximo codigo de algumas tabelas */
/**
 * @param $sNomeTabela
 * @return $id - o código da tabela ou nulo
 */
function BuscaProximoCodigo($sNomeTabela ) {
    $sql = "SELECT ULTIMO_ID FROM AUTOINC WHERE AUTOINC.TABELA = '" . $sNomeTabela . "'";
    $qry = DB::select($sql);
    $id  = null;

    if (count($qry) > 0) {
        $id = $qry[0]->ULTIMO_ID + 1;

        // atualiza os codigo
        DB::table('AUTOINC')->increment('ULTIMO_ID');
    }
    return $id;
}

function ExibeRelacionamento($obj){

    if (isset($obj)) {
        $txt = $obj;
    }
    else {
        $txt = '';
    }
    return $txt;
}

function fotoNome($id ){
    // se já tiver nome, retorna o nome
    $foto_diretorio = "fotos/jogadores/";
    $extensao = 'JPG';

    $dir = url($foto_diretorio ) ;
    $dir_arq = public_path($foto_diretorio );
    $nome = $dir . '/JOG' . $id . '.' . $extensao;
    $nomeArq =  $dir_arq . '/JOG' . $id . '.' . $extensao;

    if (file_exists($nomeArq) == FALSE) {
        $nome = $dir .'/padrao.jpg';
    }

    //$nome = $nomeArq;
    return $nome;
}