<?php   header ('Content-type: text/html; charset=UTF-8');  ?>
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
        <li><i class="fa fa-dashboard"></i> Jogadores</li>
        <li class="active">Artilheiros</li>
    </ol>
</section>
<br>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="width:50%">
                <div class="box-header">
                    <h3 class="box-title">Artilheiros</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12 col-md-6">
                        <!--
                        <div id="example_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                        </div>
                        <button type="button" value="Search" id="btnSearch" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span>Search</button>
                        <button type="button" value="Clear" id="btnClear" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span>Clear</button>
                        -->
                    </div>
                    <table class="table no-margin table-striped table-hover" id="tbl_" name="tbl_">
                        <thead>
                            <tr>
                                <th style="width:10px"></th>
                                <th style="width:300px">Apelido</th>
                                <th style="width:50px">Gols</th>
                                <th style="width:50px">Pênaltis</th>
                                <th style="width:50px">Faltas</th>
                                <th style="width:50px">Cabeça</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artilheiros as $art)
                                <tr>
                                    <td>
                                        {!!
				                            Button::success()
				                            ->extraSmall()
				                            ->asLinkTo(route('jogadores.show' , ['jogador' => $art->ID_JOGADOR]))
				                            ->withAttributes(['class'=> 'fa fa-users'], ['aria-hidden' =>"true" ])
                                         !!}
                                    </td>
                                    <td>{{$art->JOG_NOME_APELIDO}}</td>
                                    <td>{{$art->GOLS}}</td>
                                    <td>{{$art->PENALTI}}</td>
                                    <td>{{$art->FALTA}}</td>
                                    <td>{{$art->CABECA}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  <!-- /.box -->
        </div>  <!-- /.col -->
    </div> <!-- /.row -->
</section>

<script>
    $(document).ready(function () {
        $('#tbl_').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "order": [[ 1, 'asc' ]],
            "columnDefs": [{ "orderable": false , "targets": 0}],
            "language": {
                "sLengthMenu": "{!!  trans('messages.sLengthMenu') !!}",
                "sZeroRecords": "{!!  trans('messages.sZeroRecords') !!}",
                "sInfo": "{!!  trans('messages.sInfo') !!}",
                "sInfoEmpty": "{!!  trans('messages.sInfoEmpty') !!}",
                "sInfoFiltered": "{!!  trans('messages.sInfoFiltered') !!}",
                "sSearch": "{!!  trans('messages.sSearch') !!}",
                "oPaginate": {
                    "sFirst": "{!!  trans('messages.sFirst') !!}",
                    "sPrevious": "{!!  trans('messages.sPrevious') !!}",
                    "sNext": "{!!  trans('messages.sNext') !!}",
                    "sLast": "{!!  trans('messages.sLast') !!}"
                }
            }
        })
    });
</script>

@stop