<?php
header ('Content-type: text/html; charset=UTF-8');
?>
<div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-inbox"></i>
            Jogos
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body box-warning">
        <table id="categorias_jogadores" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Qtd.Jogos</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->categ_descricao}}</td>
                    <td align=right>{{$categoria->qtd}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
