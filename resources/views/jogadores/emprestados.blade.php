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
        <li class="active">Elenco</li>
    </ol>
</section>
<br>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Jogadores no Elenco - {{$status}}</h3>

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

                    @foreach ($jogadores as $jog)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-clube-active">
                                    <h3 class="widget-user-username">{{$jog->JOG_NOME_COMPLETO}}</h3>
                                    <h5 class="widget-user-desc">{{$jog->JOG_NOME_APELIDO}}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <a href="{!! route('jogadores.show' , ['jogador' => $jog->ID_JOGADOR]) !!}">
                                        <img class="img-circle" src="{{fotoNome($jog->ID_JOGADOR)}}" style="width:80px;height:80px">
                                    </a>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$jog->TIME_NOME}}</h5>
                                                <span class="description-text">Clube</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$jog->JOG_IDADE}}</h5>
                                                <span class="description-text">Idade</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">{{data_display($jog->EMPRESTIMO_FINAL)}}</h5>
                                                <span class="description-text">Final ({{$jog->DIAS_FALTAM}})</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                </div>
            </div>  <!-- /.box -->
        </div>  <!-- /.col -->
    </div> <!-- /.row -->

</section>

@stop