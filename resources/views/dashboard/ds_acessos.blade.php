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
        <!-- Acessos -->
        <div class="alert bg-teal" role="alert">
            <span>Acessos</span>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fa fa-key" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['total_mes'] }}</h3>
                        <span class="info-box-text">Acessos</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12" >
                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-percent" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <h3>{{$db['usuarios_mes']}}</h3>
                        <span class="info-box-text">Usaram</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-12" >
                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-hand-o-up" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <h3>{{$db['usuarios_unicos']}}</h3>
                        <span class="info-box-text">Únicos</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-3 col-xs-12" >
                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <h3>{{$db['departamentos_unicos']}}</h3>
                        <span class="info-box-text">Departamentos</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
    </section>
@stop

