<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Dashboard;

use Illuminate\Support\Facades\Auth;
use DB;

class ContratosController extends Controller
{
    private $contrato;

    public function total_mes()
    {
        $id_categoria = Auth::user()->categoria_selecionada();
        $ano = Auth::user()['config']->ano;

        $_sql = "SELECT ";
        $_sql .= "  T_CONT_VL_SALARIO			= SUM( A.CONT_VL_SALARIO ) ";
        $_sql .= " ,T_CONT_VL_DIREITO_IMAGEM	= SUM( A.CONT_VL_DIREITO_IMAGEM	)  ";
        //$_sql .= " ,T_CONT_VL_LUVAS             = SUM( A.CONT_VL_LUVAS )";
        //$_sql .= " ,MES = MONTH( A.CONT_DT_PAGAMENTO ) ";
        $_sql .= "   FROM CONTRATOS_PAGAMENTOS2 A ";
        $_sql .= "   INNER JOIN ELENCO          B ON A.ID_JOGADOR = B.ID_JOGADOR ";
        $_sql .= "  WHERE YEAR( A.CONT_DT_PAGAMENTO ) = " . $ano;
        $_sql .= "    AND B.ELENCO_STATUS <> 'N' ";
        $_sql .= "    AND B.ID_CATEGORIA = " . $id_categoria ;
        $_sql .= "  GROUP BY MONTH( CONT_DT_PAGAMENTO ) ";
        $_sql .= "  ORDER BY MONTH( CONT_DT_PAGAMENTO ) ";

        $reg = DB::select($_sql);
       //return dd($reg);

        $_data['data'] = $reg;
        $_json = json_encode( $_data );
        return $_json;
    }

}
