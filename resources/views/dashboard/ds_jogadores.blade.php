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
        <!-- Jogadores -->
        <div class="alert alert-success" role="alert">
            <span>Jogadores</span>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <a href="{{asset('jogadores')}}">
                    <span class="info-box-icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                        <div class="info-box-content">
                            <h3>{{ $db['jogadores_profissionais'] }}</h3>
                            <span class="info-box-text">Profissionais</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <a href="{{asset('jogadores/emprestados')}}">
                        <span class="info-box-icon">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>{{ $db['jogadores_emprestados'] }}</h3>
                            <span class="info-box-text">Emprestados</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <a href="{{asset('jogadores/grupoespecial')}}">
                        <span class="info-box-icon">
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>{{ $db['jogadores_grupoesp'] }}</h3>
                            <span class="info-box-text">Grupo Especial</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['jogadores_dm'] }}</h3>
                        <span class="info-box-text">DM</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['jogadores_chegaram'] }}</h3>
                        <span class="info-box-text">Chegaram</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['jogadores_sairam'] }}</h3>
                        <span class="info-box-text">Saíram</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-child" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['jogadores_base'] }}</h3>
                        <span class="info-box-text">Base</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <a href="{{asset('jogadores/artilheiros')}}">
                        <span class="info-box-icon">
                            <i class="fa fa-futbol-o" aria-hidden="true"></i>
                        </span>
                        <div class="info-box-content">
                            <h3>-</h3>
                            <span class="info-box-text">Artilheiros</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>
    </section>
@stop

