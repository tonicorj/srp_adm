<?php
header ('Content-type: text/html; charset=UTF-8');
?>
@extends('template')

@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Acessos por Departamentos
    </h1>
    <ol class="breadcrumb">
        <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Acessos</li>
        <li class="active">Por Departamentos</li>
    </ol>
</section>
<br>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-user"></i>
            Acessos por departamentos
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table id="tabela2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Departamentos</th>
                    <th>Jan</th>
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Mai</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ago</th>
                    <th>Set</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dez</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->departamento_descricao}}</td>
                    <td align=right>{{$usuario->janeiro}}</td>
                    <td align=right>{{$usuario->fevereiro}}</td>
                    <td align=right>{{$usuario->marco}}</td>
                    <td align=right>{{$usuario->abril}}</td>
                    <td align=right>{{$usuario->maio}}</td>
                    <td align=right>{{$usuario->junho}}</td>
                    <td align=right>{{$usuario->julho}}</td>
                    <td align=right>{{$usuario->agosto}}</td>
                    <td align=right>{{$usuario->setembro}}</td>
                    <td align=right>{{$usuario->outubro}}</td>
                    <td align=right>{{$usuario->novembro}}</td>
                    <td align=right>{{$usuario->dezembro}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@stop