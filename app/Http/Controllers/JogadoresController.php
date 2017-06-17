<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Jogadores;
use DB;
use Illuminate\Support\Facades\Auth;

class JogadoresController extends Controller
{
    protected $id_categoria;

    private $foto_padrao = 'fotos/jogadores/padrao.jpg';
    private $foto_diretorio = 'fotos/jogadores/';

    public function __construct()
    {
        $this->id_categoria = Auth::user()->categoria_selecionada();
    }

    public function index() {
        $sql  = 'select ' ;
        $sql .= ' A.ID_JOGADOR ';
        $sql .= ',A.JOG_NOME_APELIDO ';
        $sql .= ',B.JOG_NOME_COMPLETO ';
        $sql .= ',A.JOG_DT_NASCIMENTO ';
        $sql .= ',A.JOG_IDADE ';
        $sql .= ',A.JOG_POSICAO ';
        $sql .= " from f_elenco_atual_status( " . $this->id_categoria . ",'S') A ";
        $sql .= " left join jogadores b on a.id_jogador = b.id_jogador ";
        $sql .= "order by b.JOG_NOME_COMPLETO";
        $jogadores = DB::select($sql);

        $avisos = new Dashboard;
        return view('jogadores.index')
            ->with('jogadores', $jogadores)
            ->with('status', 'Ativos')
            ->with('avisos', $avisos->avisos(1));
    }

    public function show( $id)
    {
        $sigla = '';

        $jogador = Jogadores::find($id);
        if ( ! is_null($jogador->ID_PAIS)){
            $qry = DB::table('PAISES')
                ->where('ID_PAIS', '=', $jogador->ID_PAIS)
                ->select('PAIS_NOME', 'PAIS_SIGLA')
                ->get()
            ;
            $jogador->PAIS_NOME = $qry[0]->PAIS_NOME;
            $sigla = $qry[0]->PAIS_SIGLA;
        }
        if ( ! is_null($jogador->ID_CIDADE_NATAL)){
            $qry = DB::table('V_CIDADES')
                ->where('ID_CIDADE', '=', $jogador->ID_CIDADE_NATAL)
                ->select('CIDADE_NOME')
                ->get()
            ;
            $jogador->CIDADE_NATAL = $qry[0]->CIDADE_NOME;
        }
        if ( ! is_null($jogador->ID_ESCOLARIDADE)){
            $qry = DB::table('ESCOLARIDADE')
                ->where('ID_ESCOLARIDADE', '=', $jogador->ID_ESCOLARIDADE)
                ->select('ESCOLARIDADE_DESCRICAO')
                ->get()
            ;
            $jogador->ESCOLARIDADE = $qry[0]->ESCOLARIDADE_DESCRICAO;
        }
        if ( ! is_null($jogador->ID_ESTADOCIVIL)){
            $qry = DB::table('ESTADOCIBIL')
                ->where('ID_ESTADOCIVIL', '=', $jogador->ID_ESTADOCIVIL)
                ->select('ESTADOCIVIL_DESCRICAO')
                ->get()
            ;
            $jogador->ESTADOCIVIL = $qry[0]->ESTADOCIVIL_DESCRICAO;
        }
        if ( ! is_null($jogador->ID_CIDADE)){
            $qry = DB::table('V_CIDADES')
                ->where('ID_CIDADE', '=', $jogador->ID_CIDADE)
                ->select('CIDADE_NOME')
                ->get()
            ;
            $jogador->CIDADE_NOME= $qry[0]->CIDADE_NOME;
        }
        if ( ! is_null($jogador->ID_CIDADE2)){
            $qry = DB::table('V_CIDADES')
                ->where('ID_CIDADE', '=', $jogador->ID_CIDADE2)
                ->select('CIDADE_NOME')
                ->get()
            ;
            $jogador->CIDADE_NOME2= $qry[0]->CIDADE_NOME;
        }
        if ( ! is_null($jogador->ID_PARCEIRO)){
            $qry = DB::table('PARCEIROS')
                ->where('ID_PARCEIRO', '=', $jogador->ID_PARCEIRO)
                ->select('PARCEIRO_NOME')
                ->get()
            ;
            $jogador->PARCEIRO = $qry[0]->PARCEIRO_NOME;
        }

        // pega o nome do arquivo da foto
        $jogador->FOTO = $this->fotoNome($id);

        $avisos = new Dashboard;
        return view('jogadores.show')
            ->with('jogador', $jogador)
            ->with('id_categoria', $this->id_categoria)
            ->with('avisos', $avisos->avisos(1));
    }

    public function grupoespecial() {
        $sql  = 'select ' ;
        $sql .= ' ID_JOGADOR ';
        $sql .= ',JOG_NOME_APELIDO ';
        $sql .= ',JOG_NOME_COMPLETO ';
        $sql .= ',JOG_DT_NASCIMENTO ';
        $sql .= ',JOG_IDADE ';
        $sql .= ',JOG_POSICAO ';
        $sql .= " from f_elenco_atual_status( " . $this->id_categoria . ",'F')";
        $sql .= "order by jog_nome_completo";
        $jogadores = DB::select($sql);

        $avisos = new Dashboard;
        return view('jogadores.index')
            ->with('jogadores', $jogadores)
            ->with('status', 'Grupo Especial')
            ->with('avisos', $avisos->avisos(1));
    }

    public function emprestados() {
        $sql  = 'select ' ;
        $sql .= '    A.ID_JOGADOR ';
        $sql .= '   ,A.JOG_NOME_APELIDO ';
        $sql .= '	,A.JOG_NOME_COMPLETO ';
        $sql .= '	,A.JOG_DT_NASCIMENTO ';
        $sql .= '	,A.EMPRESTIMO_INICIO ';
        $sql .= '	,A.EMPRESTIMO_FINAL  ';
        $sql .= '	,A.TIME_NOME ';
        $sql .= '	,A.DIAS_FALTAM ';
        $sql .= '   ,B.JOG_IDADE ';
        $sql .= " from VS_EMPRESTIMOS A ";
        $sql .= " left join JOGADORES B on A.ID_JOGADOR = B.ID_JOGADOR ";
        $sql .= " where A.id_categoria = " . $this->id_categoria;
        $sql .= "order by A.jog_nome_completo";
        $jogadores = DB::select($sql);

        $avisos = new Dashboard;
        return view('jogadores.emprestados')
            ->with('jogadores', $jogadores)
            ->with('status', 'Emprestados')
            ->with('avisos', $avisos->avisos(1));
    }

    public function jogadores_dm() {
        $_sql = "SELECT ";
        $_sql .= "  A.JOG_NOME_APELIDO, A.JOG_NOME_COMPLETO, A.DM_DATA_INICIO, A.DM_TEMPO_PERMANENCIA, A.CATEG_DESCRICAO";
        $_sql .= ", A.ORIGEM_LESAO_DESCRICAO, A.TIPO_LESAO_DESCRICAO, A.PARTE_CORPO_DESCRICAO, A.MEDICO_NOME";
        $_sql .= "  FROM V_DM_ENTRADAS A ";
        $_sql .= " WHERE A.DM_DATA_FIM IS NULL ";
        $_sql .= "   AND A.FLAG_AFASTAMENTO = 'S'";
        $_sql .= "   AND A.ELENCO_STATUS = 'S' ";
        $_sql .= "   AND A.ID_CATEGORIA  = " . $this->id_categoria;
        $jogadores = DB::select($_sql);

        $avisos = new Dashboard;
        return view('jogadores.dm')
            ->with('jogadores', $jogadores)
            ->with('status', 'Ativos')
            ->with('avisos', $avisos->avisos(1));
    }

    public function xxjogadores_por_posicao(){
        $jog = new Jogadores;
        $jogadores = $jog->_por_posicao();
        $avisos = new Dashboard;
        return view('jogadores.por_posicao')
            ->with('jogadores', $jogadores)
            ->with('avisos', $avisos->avisos(1));
    }

    public function artilheiros_ano() {
        $jog = new Jogadores;
        $artilheiros = $jog->_artilheiros_ano(0);
        $avisos = new Dashboard;

        return view('jogadores.artilheiros')
            ->with('artilheiros', $artilheiros)
            ->with('avisos', $avisos->avisos(1));
    }

    public function jogadores_por_posicao(){
        // define as cores
        $aCores = array( 1 => "list-group-item-success", 2 => "list-group-item-warning", 3 => "list-group-item-info" );

        $j = new Jogadores;
        $jogadores = $j->_por_posicao();
        $iPosicao = -1;

        // limpa os totais
        $iQtd = array( 1 => 0, 2 => 0, 3 => 0 );
        $iTotal  = 0;

        // limpa os vertores
        $resultado = array();
        $posicao = array();
        $cores  = array();

        foreach ($jogadores as $jog) {

            $id_jogador = $jog->ID_JOGADOR;

            // se for categoria profissional, ignora data nascimento
            if ( $this->id_categoria == 1 ) {
                $sNome = $jog->JOG_NOME_APELIDO;
                if ( $jog->JOG_DT_NASCIMENTO == null)
                { $ano = ''; }
                else
                { $ano   = $jog->JOG_IDADE; }
            }
            else {
                $sNome = $jog->JOG_NOME_APELIDO;
                $ano = substr($jog->ANO, 2, 2);
            }

            if ($iPosicao <> $jog->POSICAO_ORDEM ) {

                if ( $iTotal > 0 ) {
                    $resultado[] = array( 'jog_posicao' => $jog_posicao,
                        'posicao_descricao' => $posicao_descricao,
                        'qtde' => $qtde,
                        'celulas' => $posicao
                    );
                }
                $n = 1;
                $iPosicao = $jog->POSICAO_ORDEM;

                //cdsRel_Atletas.Append
                $jog_posicao = $jog->JOG_POSICAO;
                $posicao_descricao = $jog->POSICAO_DESCRICAO;

                // limpa o array de jogadores
                $posicao = array();
                $cores   = array();
            }
            $qtde = $n;

            // pega a posição
            $status = $jog->STATUS_POSICAO;

            // pega a cor da posição
            $cores[] = $aCores[$status];
            $posicao[] = array( 'nome' => $sNome, 'ano' => $ano, 'cor' => $aCores[$status], 'id_jogador' => $id_jogador);

            // atualiza os contados
            $iQtd[$status] += 1;
            $iTotal += 1;
            $n += 1;
        }
        // inclui ultima posição
        $resultado[] = array( 'jog_posicao' => $jog_posicao,
            'posicao_descricao' => $posicao_descricao,
            'qtde'    => $qtde,
            'celulas' => $posicao
        );
        //return dd($resultado);
        $avisos = new Dashboard;
        return view('jogadores.por_posicao')
            ->with('posicoes', $resultado)
            ->with('totais', $iQtd)
            ->with('cor_padrao', $aCores)
            ->with('avisos', $avisos->avisos(1));
    }

    public function elenco_grafico() {
        $jog = new Jogadores;
        $reg = $jog->_elenco_grafico();

        $_data['data'] = $reg;
        $_json = json_encode( $_data );
        return $_json;
    }

    public function elenco_cartoes() {
        $jog = new Jogadores;
        $reg = $jog->_elenco_cartoes(18);

        //$_data['data'] = $reg;
        //$_json = json_encode( $_data );
        return $reg;
    }

    public function fotoNome($id){
        // se ja tiver nome, retorna o nome
        $nome = $this->foto_diretorio . 'JOG' . $id . '.JPG';

        if (file_exists($nome) == FALSE) {
            $nome = $this->foto_padrao;
        }

        $nome = asset($nome);
        return $nome;
    }

}
