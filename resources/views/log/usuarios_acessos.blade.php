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
    <h1>
        Acessos por Usuários
    </h1>
    <ol class="breadcrumb">
        <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Acessos</li>
        <li class="active">Por Usuários</li>
    </ol>
</section>
<br>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-user"></i>
            Acessos por usuário
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table id="tabela2" name="tabela2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width:300px">Usuário</th>
                    <th style="width:250px">Departamentos</th>
                    <th style="width:5px">Jan</th>
                    <th style="width:5px">Fev</th>
                    <th style="width:5px">Mar</th>
                    <th style="width:5px">Abr</th>
                    <th style="width:5px">Mai</th>
                    <th style="width:5px">Jun</th>
                    <th style="width:5px">Jul</th>
                    <th style="width:5px">Ago</th>
                    <th style="width:5px">Set</th>
                    <th style="width:5px">Out</th>
                    <th style="width:5px">Nov</th>
                    <th style="width:5px">Dez</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="box-body" id="graficos">
        <script type="text/javascript">
            $("#graficos").load('{{ route('log.usuarios_acessos_g')  }}');
        </script>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script>
$(document).ready(function() {
    $('#tabela2').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ordering":  false,
        "paging": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": "http://localhost:8000/log/usuarios_acessos_json",
        //"ajax": "http://localhost:8000/teste.json",
        columns: [
            {"data": "login_usuario"},
            {"data": "departamento_descricao"},
            {"data": "janeiro"},
            {"data": "fevereiro"},
            {"data": "marco"},
            {"data": "abril"},
            {"data": "maio"},
            {"data": "junho"},
            {"data": "julho"},
            {"data": "agosto"},
            {"data": "setembro"},
            {"data": "outubro"},
            {"data": "novembro"},
            {"data": "dezembro"}
        ]
    } );
} );
</script>

@stop