@extends('template')

@section('content')
    <div class="main">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <section class="col-lg-4 connectedSortable">
                    <!-- QTS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            <h3 class="box-title">QTS - @if ( $db['qts_dia'] != null ) {{ data_display($db['qts_dia'][0]->ATIVIDADE_DATA) }}@endif </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="qts_dia" class="table no-border table-striped">
                                    <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Hora</th>
                                        <th>Atividades</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($db['qts_dia'] as $qts)
                                        <tr>
                                        <!--
                                        <td >@if    ($qts->QUADRO_ATIVIDADE_POSICAO == 1) Manhã
                                            @elseif ($qts->QUADRO_ATIVIDADE_POSICAO == 2) Tarde
                                            @elseif ($qts->QUADRO_ATIVIDADE_POSICAO == 3) Noite
                                            @endif
                                                </td>
                                                -->
                                            <td>{{$qts->CATEG_DESCRICAO}}</td>
                                            <td>{{$qts->HORA}}</td>
                                            <td>@if ($qts->ATIVIDADE       != null) {{$qts->ATIVIDADE}}             @endif
                                                @if ($qts->ATIVIDADE2      != null) <BR> {{$qts->ATIVIDADE2}}       @endif
                                                @if ($qts->ATIVIDADE3      != null) <BR> {{$qts->ATIVIDADE3}}       @endif
                                                @if ($qts->LOCAL_ATIVIDADE != null) <BR> {{$qts->LOCAL_ATIVIDADE}}  @endif
                                                @if ($qts->COMPLEMENTO     != null) <BR> {{$qts->COMPLEMENTO}}      @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Painel de Contratos -->
                    <div class="box">
                        <div class="box-header with-border">
                            <i class="fa fa-file-word-o" aria-hidden="true"></i>
                            <h3 class="box-title">Painel de Contratos</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="qts_dia" class="table no-border table-striped">
                                    <tbody>
                                    @foreach ($db['painel_contratos'] as $painel)
                                        <tr>
                                            <td style="width:10%;text-align:right;"
                                                @if     ($painel->COR == 'VERMELHO') class="bg-red"
                                                @elseif ($painel->COR == 'LARANJA' ) class="bg-orange"
                                                @elseif ($painel->COR == 'AMARELO' ) class="bg-yellow"
                                                @elseif ($painel->COR == 'VERDE'   ) class="alert-success"
                                                @elseif ($painel->COR == 'AZUL'    ) class="bg-blue"
                                                    @endif
                                            >{{$painel->QTD}}
                                            </td>
                                            <td style="width:90%">{{$painel->TITULO}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-lg-5 connectedSortable">
                    <!-- Próximos Jogos -->
                    <div class="box">
                        <div class="box-header with-border">
                            <i class="fa fa-futbol-o" aria-hidden="true"></i>
                            <h3 class="box-title">Próximos Jogos</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border table-striped">
                                    <tbody>
                                    @foreach ($db['proximos_jogos'] as $jogo)
                                        <tr>
                                            <td>{{substr(data_display($jogo->PARTIDA_DATA),0,5) . " "}}</td>
                                            <td>{{$jogo->PARTIDA_HORA}}</td>
                                            <td>
                                                ({{$jogo->CASA_FORA}}) {{$jogo->TIME_ADVERSARIO}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Últimos Jogos -->
                    <div class="box">
                        <div class="box-header with-border">
                            <i class="fa fa-futbol-o" aria-hidden="true"></i>
                            <h3 class="box-title">Últimos Jogos</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border table-striped">
                                    <tbody>
                                    @foreach ($db['ultimos_jogos'] as $jogo)
                                        <tr>
                                            <td>{{substr(data_display($jogo->PARTIDA_DATA),0,5) . " "}}</td>
                                            <td>{{$jogo->PARTIDA_HORA}}</td>
                                            <td>{{$jogo->GOLS_PRO}} x {{$jogo->GOLS_CONTRA}}</td>
                                            <td>
                                                ({{$jogo->CASA_FORA}}) {{$jogo->TIME_ADVERSARIO}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- aniversariantes -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            <h3 class="box-title">Aniversariantes</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="qts_dia" class="table no-border table-striped">
                                    <thead>
                                    <tr>
                                        <th>Jogador</th>
                                        <th>Idade</th>
                                        <th>Ano</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($db['aniversariantes'] as $aniv)
                                        <tr>
                                            <td>{{$aniv->JOG_NOME_APELIDO}}</td>
                                            <td>{{$aniv->IDADE}}</td>
                                            <td>{{substr(data_display($aniv->JOG_DT_NASCIMENTO),6,4) . " "}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-lg-3 connectedSortable">
                    <!-- entradas no DM -->
                    <div class="info-box ">
                        <a href="{{asset('jogadores/dm')}}">
                        <span class="info-box-icon alert-error">
                            <i class="fa fa-medkit" aria-hidden="true"></i>
                        </span>
                            <div class="info-box-content">
                                <h3>{{ $db['jogadores_dm'] }}</h3>
                                <span class="info-box-text">Dep.Médico</span>
                            </div>
                            <!-- /.info-box-content -->
                        </a>
                    </div>

                    <!-- salário simples -->
                    <div class="info-box ">
                        <span class="info-box-icon alert-success">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>{{ number_format($db['contrato_vlr_simples'],0) }}</h3>
                            <span class="info-box-text">Salário & Dir.Imagem</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <!-- produtividade -->
                    <div class="info-box ">
                        <span class="info-box-icon alert-warning">
                            <i class="fa fa-percent" aria-hidden="true"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>{{ number_format($db['contrato_vlr_produtividade'],0) }}</h3>
                            <span class="info-box-text">Produtividade</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <!-- Valor Total -->
                    <div class="info-box ">
                        <span class="info-box-icon alert-info">
                            <i class="glyphicon glyphicon-usd"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>{{ number_format($db['contrato_vlr_total'],0) }}</h3>
                            <span class="info-box-text">Total</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </section>

            </div>  <!-- /.row -->
        </section>

        <section class="content">
            <div class="row">
                <!-- Artilharia -->
                <div class="col-lg-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <i class="fa fa-futbol-o" aria-hidden="true"></i>
                            <h3 class="box-title">Artilheiros</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="qts_dia" class="table no-border table-striped">
                                    <thead>
                                    <tr>
                                        <th>Jogoador</th>
                                        <th>Gols</th>
                                        <th>Pênaltis</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($db['artilheiros'] as $art)
                                        <tr>
                                            <td>{{$art->JOG_NOME_APELIDO}}</td>
                                            <td>{{$art->GOLS }}</td>
                                            <td>{{$art->PENALTI}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  <!-- /.box -->
                </div>

                <!-- Cartões -->
                <div class="col-lg-8">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cartões - {{$db['jogadores_cartoes']['CAMPEONATO']}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="container-fluid">
                                <div class="row text-center" style='with:"95%";text-align:center;'>
                                    <div class="col-lg-3">
                                        <div class="row bg-yellow"     role="alert" style="text-align:center;">
                                            <span>1 AMARELO</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12" style="text-align:center;">
                                                @foreach ($db['jogadores_cartoes']['AMARELO01'] as $nome)
                                                    {{$nome}}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row alert-warning"     role="alert" style="text-align:center;">
                                            <span>2 AMARELO</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @foreach ($db['jogadores_cartoes']['AMARELO02'] as $nome)
                                                    {{$nome}}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row bg-blue"     role="alert" style="text-align:center;">
                                            <span>SUSPENSO</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @foreach ($db['jogadores_cartoes']['AMARELO03'] as $nome)
                                                    {{$nome}}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row alert-danger"     role="alert" style="text-align:center;">
                                            <span>CARTÃO VERMELHO</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @foreach ($db['jogadores_cartoes']['VERMELHO'] as $nome)
                                                    {{$nome}}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col-lg-8 -->
                </div>
            </div>
        </section>

        <!-- graficos -->
        <section class="content">
            <div class="row">
                <!-- Gráfico de salários -->
                <div class="col-lg-7">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Salários & Direitos de Imagem no Ano</h3>
                        </div>
                        <div class="box-body">
                            <p id="erros"></p>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Gráfico de elenco -->
                <div class="col-lg-5">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Elenco</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:350px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /. graficos -->
    </div>

    <script>
        var opt = {
            title:{
                display:false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value, index, values) {
                            if(value>0) { value = value / 1000 }
                            if (parseInt(value) >= 1000) {
                                return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + 'k';
                            } else {
                                return '$' + value + 'k';
                            }
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '1k = 1000'
                    }
                }
                ]
            }
        }

        $.ajax({
            type: "GET",
            url: "{{ route('contratos.total_mes') }}",
            dataType: 'json',
            data:{data: []},
            contentType: "application/json; charset=utf-8",
            cache: false,
            async: true,
            success: function(result){
                try {
                    var salario = [], dirimagem = [], luvas = [];
                    result['data'].forEach(function(sal){
                        salario.push(sal.T_CONT_VL_SALARIO);
                        dirimagem.push(sal.T_CONT_VL_DIREITO_IMAGEM);
                        luvas.push(sal.T_CONT_VL_LUVAS);
                    });

                    //alert(salario);
                    var data = {
                        labels : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                        datasets : [
                            { label: 'Salário', data: salario       , backgroundColor: "rgba( 75, 192, 192, 0.4)", borderColor: "rgba( 75, 192, 192, 1)", }
                            ,{ label: 'Dir.Imagem',  data: dirimagem , backgroundColor: "rgba( 54, 162, 235, 0.2)", borderColor: "rgba( 54, 162, 235, 1)", }
                            //,{ label: 'Luvas',       data: luvas     , backgroundColor: "rgba(255, 206,  86, 0.2)", borderColor: "rgba(255, 206,  86, 1)", }
                        ],
                        borderWidth: 1
                    };
                    var ctx = document.getElementById("myChart");
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: opt,
                        responsive : true
                    });
                } catch(err) {
                    alert('Erro:' );
                    $("#erros").append(err.message);
                }
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            },
        });

        //-------------
        //- PIE CHART -
        //-------------
        $.ajax({
            type: "GET",
            url: "{{ route('jogadores.elenco_grafico') }}",
            dataType: 'json',
            data:{data: []},
            contentType: "application/json; charset=utf-8",
            cache: false,
            async: true,
            success: function(result){
                try {
                    var _status = [], _qtd = [];
                    result['data'].forEach(function(elenco){
                        _status.push(elenco.ELENCO_STATUS);
                        _qtd.push(elenco.QTD);
                    });

                    //alert(_status);

                    var data = {
                        labels: _status,
                        datasets: [
                            {
                                backgroundColor: ["#f39c12", "#00c0ef", "#00a65a", "#f56954"],
                                data: _qtd
                            }
                        ]
                    };

                    var ctx = document.getElementById("pieChart");
                    window.myBar = new Chart(ctx, {
                            type: 'doughnut',
                            data: data
                        }
                    );
                } catch(err) {
                    alert('Erro:' );
                    $("#erros").append(err.message);
                }
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\nDescição: " + erro);

                // Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            },
        });
    </script>

@endsection
