<?php
header ('Content-type: text/html; charset=UTF-8');
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-calendar"></i>
            Jogadores por Categoria
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Qtd.Entradas DM</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->categ_descricao}}</td>
                    <td align=right></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

