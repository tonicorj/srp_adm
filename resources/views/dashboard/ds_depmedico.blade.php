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
        <div class="alert bg-red-active" role="alert">
            <span>Departamento Médico</span>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['dm_entradas'] }}</h3>
                        <span class="info-box-text">DM Entradas</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['dm_acompanhamentos'] }}</h3>
                        <span class="info-box-text">Acompanhamentos</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['dm_exames'] }}</h3>
                        <span class="info-box-text">Exames</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa fa-ambulance" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <h3>{{ $db['dm_cirurgias'] }}</h3>
                        <span class="info-box-text">Cirurgias</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

