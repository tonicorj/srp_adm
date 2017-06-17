<?php
/**
 * Created by PhpStorm.
 * User: tonic
 * Date: 27/05/2017
 * Time: 02:28
 *
 * traz a imagem do jogador
 *
 */
//require 'SimpleImage.php';
//include 'bmp_resource.php';
//include 'Bmp.php';

$id = $_GET['id'];
$arq = './fotos/JOG' . $id . '_.jpg';

// se já tiver nome, retorna o nome
$foto_diretorio = 'fotos/jogadores/';

$nome =  $foto_diretorio . $arq ;

if (file_exists($nome) == FALSE) {
    $nome =  $foto_diretorio .'padrao.jpg' ;
}
echo $nome;
