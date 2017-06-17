<?php
header ('Content-type: text/html; charset=UTF-8');
?>
<div class="box box-info direct-chat direct-chat-warning">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-inbox"></i>
            Contratos por Categoria
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table id="categorias_jogadores" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Qtd.Contratos</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->categ_descricao}}</td>
                    <td style="text-align:right;">{{$categoria->qtd}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- page script -->
<script>
    $(function () {
        $('#categorias_jogadores').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>