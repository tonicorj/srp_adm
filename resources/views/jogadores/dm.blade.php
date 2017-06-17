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
        <li class="active">Afastados DM</li>
    </ol>
</section>
<br>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Afastados no Elenco - {{$status}}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Pesquisa">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table no-margin table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:100px">Apelido</th>
                                <th style="width:50px">Entrada</th>
                                <th style="width:100px">Tempo</th>
                                <th style="width:80px">Origem</th>
                                <th style="width:80px">Lesão</th>
                                <th style="width:80px">Parte do Corpo</th>
                                <th style="width:100px">Médico</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jogadores as $jog)
                                <tr>
                                    <td>{{$jog->JOG_NOME_APELIDO}}</td>
                                    <td>{{data_display($jog->DM_DATA_INICIO) }}</td>
                                    <td>{{$jog->DM_TEMPO_PERMANENCIA}}</td>
                                    <td>{{$jog->ORIGEM_LESAO_DESCRICAO}}</td>
                                    <td>{{$jog->TIPO_LESAO_DESCRICAO}}</td>
                                    <td>{{$jog->PARTE_CORPO_DESCRICAO}}</td>
                                    <td>{{$jog->MEDICO_NOME}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  <!-- /.box -->
        </div>  <!-- /.col -->
    </div> <!-- /.row -->

</section>

@stop