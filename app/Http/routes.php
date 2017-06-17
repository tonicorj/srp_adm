<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
Route::get('/', function () {
    Route::get ('/'                     , ['as' => 'log.index'                  , 'uses' =>'LogController@index'     ]);
});
*/

Route::auth();
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/home', 'HomeController@index');
Route::get('/'    , 'HomeController@index');

//Route::get('/'    , 'DashboardController@index');

Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
    Route::get ('/'                     , ['as' => 'dashboard.index'                  , 'uses' =>'DashboardController@index'      ]);
    Route::get ('jogadores'             , ['as' => 'dashboard.jogadores'              , 'uses' =>'DashboardController@jogadores'  ]);
    Route::get ('depfutebol'            , ['as' => 'dashboard.depfutebol'             , 'uses' =>'DashboardController@depfutebol' ]);
    Route::get ('depmedico'             , ['as' => 'dashboard.depmedico'              , 'uses' =>'DashboardController@depmedico'  ]);

    Route::get ('acessosdep'            , ['as' => 'dashboard.acessosdep'             , 'uses' =>'DashboardController@acessodep'  ]);
    Route::get ('acessos'               , ['as' => 'dashboard.acessos'                , 'uses' =>'DashboardController@acessos'    ]);
    Route::get ('admin'                 , ['as' => 'dashboard.admin'                  , 'uses' =>'DashboardController@admin'      ]);

    Route::get ('atletas'               , ['as' => 'dashboard.atletas'                , 'uses' =>'DashboardController@atletas'    ]);
    Route::get ('dashboard'             , ['as' => 'dashboard.dashboard'              , 'uses' =>'DashboardController@dashboard'  ]);

    Route::get ('total_mes'             , ['as' => 'dashboard.total_mes'              , 'uses' =>'DashboardController@total_mes'  ]);
    Route::get ('usuarios_mes'          , ['as' => 'dashboard.usuarios_mes'           , 'uses' =>'DashboardController@usuarios_mes'  ]);
    Route::get ('usuarios_unicos'       , ['as' => 'dashboard.usuarios_unicos'        , 'uses' =>'DashboardController@usuarios_unicos'  ]);
    Route::get ('departamentos_unicos'  , ['as' => 'dashboard.departamentos_unicos'   , 'uses' =>'DashboardController@departamentos_unicos' ]);
    Route::get ('departamentos_acessos' , ['as' => 'dashboard.departamentos_acessos'  , 'uses' =>'DashboardController@departamentos_acessos']);

    Route::get ('usuarios_acessos'      , ['as' => 'dashboard.usuarios_acessos'       , 'uses' =>'DashboardController@usuarios_acessos'     ]);
    Route::get ('usuarios_acessos_g'    , ['as' => 'dashboard.usuarios_acessos_g'     , 'uses' =>'DashboardController@usuarios_acessos_g'   ]);
    Route::get ('usuarios_acessos_json' , ['as' => 'dashboard.usuarios_acessos_json'  , 'uses' =>'DashboardController@usuarios_acessos_json']);
});

Route::group(['prefix'=>'jogadores', 'middleware' => 'auth'], function(){
    Route::get ('/'                     , ['as' => 'jogadores.index'            , 'uses' =>'JogadoresController@index'          ]);
    Route::get ('json'                  , ['as' => 'jogadores.json'             , 'uses' =>'JogadoresController@json'           ]);
    Route::get ('show/{id}'             , ['as' => 'jogadores.show'             , 'uses' =>'JogadoresController@show'           ]);
    Route::get ('grupoespecial'         , ['as' => 'jogadores.grupoespecial'    , 'uses' =>'JogadoresController@grupoespecial'  ]);
    Route::get ('emprestados'           , ['as' => 'jogadores.emprestados'      , 'uses' =>'JogadoresController@emprestados'    ]);
    Route::get ('dm'                    , ['as' => 'jogadores.dm'               , 'uses' =>'JogadoresController@jogadores_dm'   ]);
    Route::get ('por_posicao'           , ['as' => 'jogadores.por_posicao'      , 'uses' =>'JogadoresController@jogadores_por_posicao'   ]);
    Route::get ('artilheiros'           , ['as' => 'jogadores.artilheiros'      , 'uses' =>'JogadoresController@artilheiros_ano']);
    Route::get ('elenco_grafico'        , ['as' => 'jogadores.elenco_grafico'   , 'uses' =>'JogadoresController@elenco_grafico' ]);
    Route::get ('elenco_cartoes'        , ['as' => 'jogadores.elenco_cartoes'   , 'uses' =>'JogadoresController@elenco_cartoes' ]);

});

Route::group(['prefix'=>'categorias', 'middleware' => 'auth'], function(){
    Route::get ('jogadores'             , ['as' => 'categorias.jogadores'       , 'uses' =>'CategoriasController@jogadores'  ]);
    Route::get ('contratos'             , ['as' => 'categorias.contratos'       , 'uses' =>'CategoriasController@contratos'  ]);
    Route::get ('contratos_g'           , ['as' => 'categorias.contratos_g'     , 'uses' =>'CategoriasController@contratos_g']);

    Route::get ('dm_ano'                , ['as' => 'categorias.dm_ano'          , 'uses' =>'CategoriasController@dm_ano'  ]);
    Route::get ('dm_mes'                , ['as' => 'categorias.dm_mes'          , 'uses' =>'CategoriasController@dm_mes'  ]);

    Route::get ('ocorrencias'           , ['as' => 'categorias.ocorrencias'     , 'uses' =>'CategoriasController@ocorrencias'   ]);
    Route::get ('concentracoes'         , ['as' => 'categorias.concentracoes'   , 'uses' =>'CategoriasController@concentracoes' ]);

    Route::get ('qts'                   , ['as' => 'categorias.qts'             , 'uses' =>'CategoriasController@qts'           ]);
    Route::get ('prep_fisica'           , ['as' => 'categorias.prep_fisica'     , 'uses' =>'CategoriasController@prep_fisica'   ]);

    Route::get ('jogos'                 , ['as' => 'categorias.jogos'           , 'uses' =>'CategoriasController@jogos'   ]);
    Route::get ('jogos_jogadores'       , ['as' => 'categorias.jogos_jogadores' , 'uses' =>'CategoriasController@jogos_jogadores']);

    Route::get ('assistencia_social'    , ['as' => 'categorias.assistencia_social', 'uses' =>'CategoriasController@assistencia_social']);
    Route::get ('pedagogia'             , ['as' => 'categorias.pedagogia'       , 'uses' =>'CategoriasController@pedagogia']);
    Route::get ('fisioterapia'          , ['as' => 'categorias.fisioterapia'    , 'uses' =>'CategoriasController@fisioterapia']);

});

/*
Route::group(['prefix'=>'user', 'middleware' => 'auth'], function(){
    Route::post ('altera_categoria'      , ['as' => 'user.altera_categoria', 'uses' =>'UserController@altera_categoria']);
});
*/
//Route::get('user/altera_categoria/{id}', function (){ return "Entrou na rota"; });
Route::get('config/altera_categoria/{id}', ['as' => 'config.altera_categoria', 'uses' => 'ConfigController@altera_categoria']);

Route::group(['prefix'=>'parametros', 'middleware' => 'auth'], function(){
    Route::get ('escudo'                , ['as' => 'parametros.escudo'          , 'uses' =>'ParametrosController@escudo'  ]);
});

Route::group(['prefix'=>'contratos', 'middleware' => 'auth'], function(){
    Route::get ('total_mes'             , ['as' => 'contratos.total_mes'        , 'uses' =>'ContratosController@total_mes'      ]);
});



