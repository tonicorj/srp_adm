<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DB;

class Config extends Model
{
    //
    public $mes;
    public $ano;


    public function __construct(){

        // define mês e ano atuais, se não estiver selecionados
        if ( is_null(Session::get('mes')) ) {
            $mess = date('M');

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

        if ( is_null(Session::get('ano')) ) {
            $this->ano = date('Y');
        }
    }

    /**
     * @return mixed
     */
    public function getMes()
    {
        $this->mes = Session::get('mes');
        return $this->mes;
    }

    /**
     * @param mixed $mes
     */
    public function setMes($mes)
    {
        $this->mes = $mes;
        Session::put('mes', $this->mes);
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        $this->mes = Session::get('ano');
        return $this->ano;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano)
    {
        $this->ano = $ano;
        Session::put('ano', $this->ano);
    }

    /**
     * retorna a categoria selecionada
     *
     * @return mixed    o id da categoria selecionada
     */
    public static function categoria_selecionada()
    {
        $id_usuario = Auth::user()->id;
        $id_categoria = Session::get('ID_CATEGORIA_ATUAL', null) ;
        if ( is_null($id_categoria)) {
            $sql = "select a.id_categoria_padrao, a.id_usuario ";
            $sql = $sql . " from usuarios a ";
            $sql = $sql . "where id_usuario = '" . $id_usuario . "'";
            $reg = DB::select($sql);
            $id_categoria = $reg[0]->id_categoria_padrao;
            Session::put('ID_CATEGORIA_ATUAL', $id_categoria);
        }
        return $id_categoria;
    }

    /**
     * traz a descrição da categoria atual
     *
     * @return string   descricao da categoria
     */
    public static function categoria_descricao()
    {
        $id_categoria = Session::get('ID_CATEGORIA_ATUAL');
        $sql = "select categ_descricao from categorias where id_categoria = " . $id_categoria;
        //return dd($sql);
        $reg = DB::select($sql);

        if ( sizeof($reg) == 0 ) {
            $retorno = 'Não encontrada.';
        }
        else {
            $retorno = $reg[0]->categ_descricao;
        }
        return $retorno ;
    }

    /**
     * Retorna as categorias do usuario logado
     *
     * @return mixed    array com categorias do usuário
     */
    public static function categorias(){
        $id = Auth::user()->id;
        $sql = "select a.id_categoria, a.categ_descricao ";
        $sql = $sql . " from categorias a ";
        $sql = $sql . "where id_categoria in ";
        $sql = $sql . " ( select id_categoria from usuario_categoria where id_usuario = " . $id . " ) ";
        $reg = DB::select($sql);
        return $reg;
    }

    /**
     *
     *  retorna as categorias do usuário em uma string para usar em expressões sql
     *
     * @return string   filtro para usar em instruções sql
     */
    public static function categoriasFiltroSQL(){
        $id = Auth::user()->id;
        $sql = "select a.id_categoria, a.categ_descricao ";
        $sql = $sql . " from categorias a ";
        $sql = $sql . "where id_categoria in ";
        $sql = $sql . " ( select id_categoria from usuario_categoria where id_usuario = " . $id . " ) ";
        $reg = DB::select($sql);

        $filtro = "";
        foreach ($reg as $cat ) {
            if ($filtro == "") {
                $filtro = "(";
            } else {
                $filtro = $filtro . ",";
            }

            $filtro = $filtro . $cat->id_categoria;
        }

        $filtro = $filtro . ")";
        return $filtro;
    }
}
