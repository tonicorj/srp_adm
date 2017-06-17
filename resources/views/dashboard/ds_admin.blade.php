<?php header ('Content-type: text/html; charset=UTF-8'); ?>
@extends('template')
@section('content')

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
        <!-- Administrativos -->
        <div class="alert bg-teal" role="alert">
            <span>Administrativo</span>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-bed" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['alojamento_chegaram'] }}</h3>
                        <span class="info-box-text">Alojamento</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['alojamento_sairam'] }}</h3>
                        <span class="info-box-text">Saíram</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fa fa-random" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['adm_mudancasCategoria'] }}</h3>
                        <span class="info-box-text">Troca Categoria</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['adm_ocorrencias'] }}</h3>
                        <span class="info-box-text">Ocorrências</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="glyphicon glyphicon-user"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['funcionarios_qtd'] }}</h3>
                        <span class="info-box-text">Funcionários</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>  <!-- row -->
    </section>
@stop

