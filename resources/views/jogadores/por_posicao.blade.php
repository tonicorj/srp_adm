<?php
header ('Content-type: text/html; charset=UTF-8');
?>
@extends('template')

@section('content')

<style>
    table.display thead th div.DataTables_sort_wrapper {
        padding: 0
    }
    table.display thead th {
        padding: 3px
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Elenco por Posição</li>
    </ol>
</section>
<br>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Elenco por Posição</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive ">
                        <div class="row no-padding" style="width: 100%">
                            <div class="col-lg-2">
                                <h3 class="box-title">Totais</h3>
                            </div>
                            <div class="col-lg-10 nav nav-pills" role="tablist">
                                <ul class="list-group no-padding">
                                    <li class="list-group-item col-lg-3">
                                        <span class="badge bg-blue">{{ $totais[1] + $totais[2] + $totais[3] }}</span>
                                        Elenco
                                    </li>
                                    <li class="list-group-item col-lg-3 {{ $cor_padrao[1] }}">
                                        <span class="badge bg-blue">{{ $totais[1]}}</span>
                                        Ativo
                                    </li>
                                    <li class="list-group-item col-lg-3 {{ $cor_padrao[2] }}">
                                        <span class="badge bg-blue">{{ $totais[2]}}</span>
                                        Grupo Especial
                                    </li>
                                    <li class="list-group-item col-lg-3 {{ $cor_padrao[3] }}">
                                        <span class="badge bg-blue">{{ $totais[3]}}</span>
                                        Emprestados
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @foreach ($posicoes as $pos)
                            <div class="row table-bordered" style="width: 100%">
                                <div class="col-lg-2">
                                    {{$pos['posicao_descricao']}}
                                </div>

                                <div class="col-lg-10 nav nav-pills table-bordered" role="tablist">
                                    <ul class="list-group no-padding">
                                        @foreach ($pos['celulas'] as $celula)
                                            <a href="{{route('jogadores.show' , ['jogador' => $celula['id_jogador']])}}">
                                                <li class="list-group-item col-lg-3 {{ isset($celula['cor']) ? $celula['cor'] : '' }}">
                                                    {{ $celula['nome'] }}
                                                    <span class="badge">{{ $celula['ano'] }}</span>
                                                </li>
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>  <!-- /.box -->
        </div>  <!-- /.col -->
    </div> <!-- /.row -->

</section>

<script>
    $(function () {
        $('#tbl_jogadores').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
</script>

@stop