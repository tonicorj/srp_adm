<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Usuarios;

class Dashboard extends Model
{
    //define os campos atualiz�veis
    protected $fillable = ['usuario', 'data_hora', 'mensagem'];
    protected $primaryKey = 'data_hora';


    /*
     * controla a exibição dos avissos
     *
     */
    public function avisos( $id_categoria ) {

        $usuario = new \App\Usuarios;


        $avisos = array (
            // AVISOS
            'avisos_ocorrencias'    => $this->tot_avisos_ocorrencias($id_categoria),
            'ocorrencias'           => $this->avisos_ocorrencias($id_categoria),
            'escudo'                => 'palmeiras-sp.png',
        );
        return $avisos;
    }

    // avisos na parte de cima
    public function tot_avisos_ocorrencias($id_categoria) {
        $_sql = "SELECT COUNT(*) AS QTD ";
        $_sql .= "  FROM JOGADOR_OCORRENCIA A ";
        $_sql .= " WHERE ( A.OCORR_DATA = GETDATE() ) ";
        //$_sql = $_sql . "   AND A.ID_CATEGORIA = " . $id_categoria;
        $qry = DB::select($_sql);
        return $qry[0]->QTD;
    }

    public function avisos_ocorrencias($id_categoria) {
        $_sql = "select TOP 10 ";
        $_sql .= "  A.OCORR_DESCRICAO ";
        $_sql .= ", A.OCORR_DATA ";
        $_sql .= ", B.JOG_NOME_APELIDO ";
        $_sql .= ", A.OCORR_TIPO ";
        $_sql .= " from JOGADOR_OCORRENCIA A INNER JOIN JOGADORES B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql .= " where A.OCORR_TIPO > 0 ";
        $_sql .= " order by A.OCORR_DATA ";

        $ocorrencias = DB::select($_sql);
        return $ocorrencias;
    }
}
