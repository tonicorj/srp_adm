<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Usuarios extends Model
{
    private $id_usuario;
    private $id_categoria;
    private $categorias = array();

    //
    public function __construct(array $attributes = [])
    {
        // pega o id do usuário atual
        $this->id_usuario = Auth::user()->id;

        //return dd($this->id_usuario);

        $this->id_categoria = Session::get('ID_CATEGORIA_ATUAL', null) ;
        if ( is_null($this->id_categoria)){
            $sql = "select a.id_categoria_padrao, a.id_usuario ";
            $sql = $sql . " from usuarios a ";
            $sql = $sql . "where id_usuario = '" . $this->id_usuario . "'";
            $reg = DB::select($sql);
            $this->id_categoria = $reg[0]->id_categoria_padrao;
            //return dd($reg);
            Session::put('ID_CATEGORIA_ATUAL', $this->id_categoria );
        }

        $sql = "select a.id_categoria, a.categ_descricao ";
        $sql = $sql . " from categorias a ";
        $sql = $sql . "where id_categoria in ";
        $sql = $sql . " ( select id_categoria from usuario_categoria where id_usuario = " . $this->id_usuario . " ) ";
        $reg = DB::select($sql);

        Session::put('CATEGORIAS', $reg);
        //return dd(Session::get('CATEGORIAS'));
        parent::__construct($attributes);
    }

    public static function categoria_selecionada()
    {
        return Session::get('ID_CATEGORIA_ATUAL', 1);
    }

    public static function categoria_descricao()
    {
        return dd(Session::get('CATEGORIAS'));

        $id = Session::get('ID_CATEGORIA_ATUAL', 1);
        $categorias = Session::get('CATEGORIAS');

        $i = array_search ( $id, array_column($categorias, 'id_categoria'));
        return dd($categorias);
        //return ['categ_descricao'];
    }

    public static function categorias()
    {
        return Session::get('CATEGORIAS');
    }
}
