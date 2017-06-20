<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use DB;
//use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    protected $id_usuario;
    protected $id_categoria;
    protected $categoria_descricao;

    protected $config;

    public function __construct(array $attributes = [])
    {
        $this->config = new Config;
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function categoria_selecionada()
    {
        //$config = new Config;
        //return $config->categoria_selecionada();
        return $this->config->categoria_selecionada();
    }

    public static function categoria_descricao()
    {
        $config = new Config;
        return $config->categoria_descricao();
    }

    public static function categorias()
    {
        $config = new Config;
        return $config->categorias();
    }

    public static function altera_categoria($id_categoria)
    {
        Session::put('ID_CATEGORIA_ATUAL', $id_categoria);
        return self::categoria_descricao();
    }

    public static function cliente()
    {
        $sql = "select id_time from configura";
        $reg = DB::select($sql);
        //return dd($reg);
        return $reg[0]->id_time;
    }

    public static function logoCliente(){
        $logo = "logo.bmp";

        $sql = "select id_time from configura";
        $reg = DB::select($sql);
        $id_cliente = $reg[0]->id_time;

        if ($id_cliente == 7) {
            $logo = "palmeiras.bmp";
        }
        if ($id_cliente == 18) {
            $logo = "bahia.bmp";
        }
        if ($id_cliente == 21) {
            $logo = "sport.bmp";
        }

        $logo = asset("imagens/" ) . "/" . $logo;
        return $logo;
    }

    public static function skin(){
        $skin = "skin-purple";

        $sql = "select id_time from configura";
        $reg = DB::select($sql);
        $id_cliente = $reg[0]->id_time;

        if ($id_cliente == 7) {
            $skin = "skin-green-light";
        }
        if ($id_cliente == 18) {
            $skin = "skin-blue";
        }
        if ($id_cliente == 21) {
            $skin = "skin-red";
        }
        return $skin;
    }


}