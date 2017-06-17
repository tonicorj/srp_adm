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
        <div class="alert alert-success" role="alert">
            <span>Departamento de Futebol</span>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['qts_total'] }}</h3>
                        <span class="info-box-text">Atividades</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-futbol-o" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['qts_total'] }}</h3>
                        <span class="info-box-text">Jogos</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['viagens_total'] }}</h3>
                        <span class="info-box-text">Viagens</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </section>
@stop

