<?php
header ('Content-type: text/html; charset=UTF-8');
?>
<div class="box box-info direct-chat direct-chat-warning">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa  fa-tasks"></i>
            QTS
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Atividades</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->categ_descricao}}</td>
                    <td align=right>{{$categoria->total}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

