<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Jogadores extends Model
{
    protected $table      = 'jogadores';
    protected $primaryKey = 'id_jogador';

    protected $fillable   =
        ['ID_JOGADOR'
        ,'ID_TIME_INICIAL'
        ,'ID_PAIS'
        ,'JOG_NOME_APELIDO'
        ,'JOG_NOME_COMPLETO'
        ,'JOG_DT_NASCIMENTO'
        ,'JOG_NOME_PAI'
        ,'JOG_NOME_MAE'
        ,'JOG_ALTURA'
        ,'JOG_PESO'
        ,'JOG_POSICAO'
        ,'JOG_WWW'
        ,'JOG_EMAIL'
        ,'JOG_NUM_PE'
        ,'JOG_OBSERVACOES'
        ,'JOG_CPF'
        ,'JOG_IDENTIDADE'
        ,'JOG_CARTEIRA_TRABALHO'
        ,'JOG_CBF'
        ,'JOG_REG_ESTADUAL'
        ,'JOG_ESTADO_CIVIL'
        ,'JOG_ENDERECO'
        ,'JOG_BAIRRO'
        ,'ID_CIDADE'
        ,'JOG_CEP'
        ,'JOG_TEL1'
        ,'JOG_TEL2'
        ,'JOG_TEL3'
        ,'JOG_TEL4'
        ,'JOG_ENDERECO2'
        ,'JOG_BAIRRO2'
        ,'ID_CIDADE2'
        ,'JOG_CEP2'
        ,'JOG_PASSAPORTE'
        ,'JOG_REFTEL1'
        ,'JOG_REFTEL2'
        ,'JOG_REFTEL3'
        ,'JOG_REFTEL4'
        ,'JOG_MANEQUIM'
        ,'JOG_IDADE'
        ,'UF'
        ,'UF2'
        ,'ID_CIDADE_NATAL'
        ,'UF_NATAL'
        ,'ID_PARCEIRO'
        ,'JOG_DATA_RESCISAO'
        ,'JOG_RESPONSAVEL_LEGAL'
        ,'JOG_PASSAPORTE_VENCIMENTO'
        ,'JOG_CERTIFICADO_MILITAR'
        ,'JOG_PIS'
        ,'JOG_TITULO_ELEITOR'
        ,'JOG_ZONA'
        ,'JOG_SECAO'
        ,'JOG_IDENTIDADE_EMISSAO'
        ,'RESP_LEGAL_TUTOR'
        ,'CERT_LIVRO'
        ,'CERT_TERMO'
        ,'CERT_FOLHA'
        ,'CERT_CARTORIO'
        ,'JOG_PASSAPORTE_EMISSAO'
        ,'JOG_IDENTIDADE_VENCIMENTO'
        ,'JOG_PLANO_SAUDE'
        ,'JOG_AMADOR_PROF'
        ,'JOG_RA'
        ,'JOG_CUIDADOR_ENDERECO'
        ,'JOG_CUIDADOR_TELEFONE'
        ,'JOG_AUTORIZACAO_ALOJAMENTO'
        ,'JOG_CARTEIRA_VACINA'
        ,'JOG_ORIGEM'
        ,'JOG_DOCUMENTOS_PAI'
        ,'JOG_DOCUMENTOS_MAE'
        ,'JOG_BANCO_NOME'
        ,'JOG_BANCO_AGENCIA'
        ,'JOG_BANCO_CONTA'
        ,'JOG_BANCO_TIPO_CONTA'
        ,'JOG_NOME_PLANO_SAUDE'
        ,'JOG_VISTO_NUMERO'
        ,'JOG_VISTO_VENCIMENTO'
        ,'ORIGEM_JOGADOR_ID'
        ,'JOG_TITULO_CIDADE'
        ,'ELENCO_STATUS'
        ,'JOG_NOTA'
        ,'JOG_PE_DOMINANTE'
        ,'JOG_POS_ALTERNATIVA'
        ,'ID_CLASSIF'
        ,'JOG_BASE'
        ,'ID_ESCOLARIDADE'
        ,'JOG_FORMACAO'
        ,'JOG_IMAGEM'
    ];

    public $id_categoria;

    public function __construct(array $attributes = [])
    {
        // pega a categoria atual
        $this->id_categoria = Auth::user()->categoria_selecionada();
        parent::__construct($attributes);
    }

    public static function _artilheiros_ano( $registros ){
        $id_categoria = Auth::user()->categoria_selecionada();

        $sql = "select ";
        if ($registros > 0) {
            $sql .= " TOP " . $registros;
        }

        $sql .= "  A.ID_JOGADOR ";
        $sql .= " ,C.JOG_NOME_APELIDO ";
        $sql .= " ,COUNT(A.GOL_MINUTO)	AS GOLS ";
        $sql .= " ,COUNT(A.GOL_PENALTI)	AS PENALTI ";
        $sql .= " ,COUNT(A.GOL_FALTA)	AS FALTA ";
        $sql .= " ,COUNT(A.GOL_CABECA)	AS CABECA ";
        //$sql .= " ,COUNT(A.GOL_CONTRA)	AS CONTRA";
        $sql .= "  from PARTIDAGOLS    A ";
        $sql .= "  left join TABELA    B on A.ID_JOGO = B.ID_JOGO ";
        $sql .= "  left join V_ELENCO  C on A.ID_JOGADOR = C.ID_JOGADOR ";
        $sql .= " where C.ID_CATEGORIA = " . $id_categoria;
        $sql .= "   and ( YEAR( B.PARTIDA_DATA ) = 2016 ) ";    //--YEAR(GETDATE()) )"
        $sql .= "   and ( A.GOL_CONTRA IS NULL ) ";
        $sql .= " group by  A.ID_JOGADOR, C.JOG_NOME_APELIDO ";
        $sql .= " order by 2 desc, 1 ";
        $jogadores = DB::select($sql);
        return $jogadores;
    }

    public function _por_posicao(){
        $id_categoria = Auth::user()->categoria_selecionada();

        $sql = "select a.* ";
        $sql .= ", b.POSICAO_DESCRICAO ";
        $sql .= ", b.POSICAO_ORDEM ";
        $sql .= ", case ( elenco_status ) ";
        $sql .= "  when 'S' then 1 ";
        $sql .= "  when 'F' then 2 ";
        $sql .= "           else 3 ";
        $sql .= "  end STATUS_POSICAO ";
        $sql .= ", year( a.jog_dt_nascimento ) as ANO ";
        $sql .= " from v_elenco a left join POSICAO b on a.jog_posicao = b.POSICAO ";
        $sql .= " where id_categoria = " . $id_categoria;
        $sql .= "   and a.elenco_status <> 'N' ";
        $sql .= " order by ";
        $sql .= "   b.posicao_ordem ";
        $sql .= " , b.posicao_descricao ";
        $sql .= " , case ( elenco_status ) ";
        $sql .= "    when 'S' then 1 ";
        $sql .= "    when 'F' then 2 ";
        $sql .= "	          else 3 end ";
        $jogadores = DB::select($sql);
        return $jogadores;
    }

    public function _elenco_grafico(){
        $id_categoria = Auth::user()->categoria_selecionada();

        $sql =  " SELECT ";
        $sql .= "  CASE ELENCO_STATUS ";
        $sql .= "  WHEN 'S' THEN 'ATIVOS' ";
        $sql .= "  WHEN 'E' THEN 'EMPRESTADOS' ";
        $sql .= "  WHEN 'F' THEN 'GRUPO ESPECIAL' ";
        $sql .= "  END AS ELENCO_STATUS ";
        $sql .= " ,COUNT( ID_JOGADOR ) AS QTD ";
        $sql .= "   FROM V_ELENCO   E ";
        $sql .= " WHERE E.ID_CATEGORIA  = " . $id_categoria;
        $sql .= "   AND E.ESTA_NO_DM = 'N' ";
        $sql .= "   AND E.ELENCO_STATUS <> 'N' ";
        $sql .= " GROUP BY ELENCO_STATUS ";
        $sql .= " UNION ALL ";
        $sql .= " SELECT ";
        $sql .= "   'DM'	AS ELENCO_STATUS ";
        $sql .= " , COUNT( ID_JOGADOR ) AS QTD ";
        $sql .= "  FROM V_ELENCO   E ";
        $sql .= "WHERE E.ID_CATEGORIA  = " . $id_categoria;
        $sql .= "  AND E.ESTA_NO_DM <> 'N' ";
        $sql .= "  AND E.ELENCO_STATUS <> 'N' ";

        //return dd($sql);
        $jogadores = DB::select($sql);
        return $jogadores;
    }

    public static function _elenco_cartoes( $codcamp ){

        $sql = " SELECT ";
        $sql .= "   X.ID_JOGADOR ";
        $sql .= " , X.TOTAL_CA ";
        $sql .= " , X.TOTAL_CV ";
        $sql .= " , X.CONTROLE_CA ";
        $sql .= " , ( X.TOTAL_CA - ( X.SERIE * X.CONTROLE_CA ) ) AS SERIE_ATUAL ";
        $sql .= " , CASE WHEN ( X.ULTIMA_PARTIDA = X.ULTIMO_CV ) THEN 'X' ELSE NULL END SERIE_ATUAL_CV ";
        $sql .= " , CASE WHEN (( X.TOTAL_CA - ( X.SERIE * X.CONTROLE_CA ) ) = 1) THEN B.JOG_NOME_APELIDO ELSE '' END	CARTAO_01 ";
        $sql .= " , CASE WHEN (( X.TOTAL_CA - ( X.SERIE * X.CONTROLE_CA ) ) = 2) THEN B.JOG_NOME_APELIDO ELSE '' END	CARTAO_02 ";
        $sql .= " , CASE WHEN ((( X.TOTAL_CA - ( X.SERIE * X.CONTROLE_CA ) ) = 0) AND ( X.ULTIMA_PARTIDA = X.ULTIMO_CA )) THEN 3 ELSE 0 END	SUSPENSO ";
        $sql .= " , B.JOG_NOME_APELIDO ";
        $sql .= " , B.JOG_NOME_COMPLETO ";
        $sql .= " , J.CAMP_NOME ";
        $sql .= " , J.CAMP_ANO ";
        $sql .= " , J.GOLS_PRO ";
        $sql .= " , J.GOLS_CONTRA ";
        $sql .= " , J.time_adversario ";
        $sql .= " , J.estadio_nome ";
        $sql .= " FROM ( ";
        $sql .= "     SELECT ";
        $sql .= "	  A.ID_JOGADOR ";
        $sql .= "    ,MAX( U.ULTIMA_PARTIDA  ) AS ULTIMA_PARTIDA ";
        $sql .= "    ,COUNT( A.JOG_PARTIDA_CA ) AS TOTAL_CA ";
        $sql .= "	 ,COUNT( A.JOG_PARTIDA_CV ) AS TOTAL_CV ";
        $sql .= "	 ,MAX( CASE WHEN ( ISNULL( C.CAMP_NUMERO_CA, 0 ) = 0 ) THEN 3 ELSE C.CAMP_NUMERO_CA END ) AS CONTROLE_CA ";
        $sql .= "	 ,COUNT( A.JOG_PARTIDA_CA )  / MAX( CASE WHEN ( ISNULL( C.CAMP_NUMERO_CA, 0 ) = 0 ) THEN 3 ELSE C.CAMP_NUMERO_CA END ) AS SERIE ";
        $sql .= "	 ,MAX( CASE WHEN ( A.JOG_PARTIDA_CV IS NULL ) THEN NULL ELSE B.PARTIDA_DATA END ) AS ULTIMO_CV ";
        $sql .= "	 ,MAX( CASE WHEN ( A.JOG_PARTIDA_CA IS NULL ) THEN NULL ELSE B.PARTIDA_DATA END ) AS ULTIMO_CA ";
        $sql .= "	  FROM PARTIDAJOGADORES A ";
        $sql .= "	  INNER JOIN TABELA      B ON A.ID_JOGO = B.ID_JOGO ";
        $sql .= "	  INNER JOIN CAMPEONATO  C ON B.ID_CAMPEONATO = C.ID_CAMPEONATO ";
        $sql .= "	 ,( SELECT MAX( PARTIDA_DATA ) AS ULTIMA_PARTIDA FROM TABELA WHERE ID_CAMPEONATO = " . $codcamp . " AND PARTIDA_DATA <= GETDATE() ) U ";
        $sql .= "	 WHERE C.ID_CAMPEONATO = " . $codcamp ;
        $sql .= "      AND NOT A.JOG_PARTIDA_CA IS NULL ";
        $sql .= "      AND B.PARTIDA_DATA <= GETDATE() ";
        $sql .= "      AND NOT B.PARTIDA_GOL_A IS NULL ";
        $sql .= "	 GROUP BY A.ID_JOGADOR ";
        $sql .= "	) X ";
        $sql .= "	LEFT JOIN JOGADORES B ON X.ID_JOGADOR = B.ID_JOGADOR ";
        $sql .= "	, ( SELECT TOP 1 * ";
        $sql .= "        FROM vw_jogos ";
        $sql .= "		 WHERE ID_CAMPEONATO = " . $codcamp;
        $sql .= "        AND PARTIDA_DATA <= GETDATE() ";
        $sql .= "		 ORDER BY PARTIDA_DATA DESC ";
        $sql .= "	   ) J ";
        $sql .= " ORDER BY B.JOG_NOME_APELIDO ";
        $qry = DB::select($sql);

        $amarelos = [ 'CAMPEONATO' => ''
            , 'AMARELO01' => array()
            , 'AMARELO02' => array()
            , 'AMARELO03' => array()
            , 'VERMELHO' => array() ];

        if ($qry != null) {
            foreach ($qry as $reg) {
                $camp = $reg->CAMP_NOME;
                $nome = $reg->JOG_NOME_APELIDO;

                $campo = '';
                if ($reg->SERIE_ATUAL == 1) {
                    $campo = 'AMARELO01';
                }
                if ($reg->SERIE_ATUAL == 2) {
                    $campo = 'AMARELO02';
                }
                if ($reg->SUSPENSO == 3) {
                    $campo = 'AMARELO03';
                }
                if ($reg->SERIE_ATUAL_CV != null) {
                    $campo = 'VERMELHO';
                }

                if ($campo != '') {
                    $pos = array_search($nome, $amarelos[$campo]);
                    if ($pos == false)
                        $amarelos[$campo][] = $nome;
                }

            }
            // grava o nome do campeonato
            $amarelos['CAMPEONATO'] = $camp;
        }

        //dd($amarelos);
        return $amarelos;
    }

}
