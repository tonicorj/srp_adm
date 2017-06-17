<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Auth;


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

    public static function categorias(){
        $config = new Config;
        return $config->categorias();
    }

    public static function altera_categoria ($id_categoria){
        Session::put('ID_CATEGORIA_ATUAL', $id_categoria);
        return self::categoria_descricao();
    }

}