<?php header ('Content-type: text/html; charset=UTF-8'); ?>
@extends('template')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Jogadores</li>
            <li class="active">Qtd.Por Elenco</li>
        </ol>
    </section>
    <br>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Jogadores por Categoria</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="categorias_jogadores" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width:400px">Categoria</th>
                                <th style="width:150px">Ativos</th>
                                <th style="width:150px">Emprestados</th>
                                <th style="width:150px">Grupo Especial</th>
                                <th style="width:150px">Total</th>
                                <th style="width:10px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categorias as $jog)
                                <tr>
                                    <td >{{$jog->categ_descricao}}</td>
                                    <td >{{$jog->ativos}}</td>
                                    <td >{{$jog->emprestados}}</td>
                                    <td >{{$jog->grupo_especial}}</td>
                                    <td >{{$jog->total_jog}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  <!-- /.box -->
            </div>  <!-- /.col -->
        </div> <!-- /.row -->
        <!-- /.box-body -->
    </section>

@stop
