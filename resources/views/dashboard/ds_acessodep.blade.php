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
        <div class="alert bg-teal" role="alert">
            <span>Acessos por Departamento</span>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['servsocial_atendimentos'] }}</h3>
                        <span class="info-box-text">Serviço Social</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['servsocial_estudantes'] }}</h3>
                        <span class="info-box-text">Estudantes</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                </span>
                    <div class="info-box-content">
                        <h3>{{ $db['psicologia_atendimentos'] }}</h3>
                        <span class="info-box-text">Psicologia</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                <span class="info-box-icon">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                </span>
                    <div class="info-box-content">
                        <h3>{{ $db['nutricao_atendimentos'] }}</h3>
                        <span class="info-box-text">Nutrição</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['fisiologia_atendimentos'] }}</h3>
                        <span class="info-box-text">Fisiologia</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-male" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['fisioterapia_atendimentos'] }}</h3>
                        <span class="info-box-text">Fisioterapia</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="glyphicon glyphicon-flash"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['prepfisica_atendimentos'] }}</h3>
                        <span class="info-box-text">Prep.Física</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['prepfisica_jogadores'] }}</h3>
                        <span class="info-box-text">PF Jogadores</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['entrevistas_total'] }}</h3>
                        <span class="info-box-text">Entrevistas</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </section>
@stop

