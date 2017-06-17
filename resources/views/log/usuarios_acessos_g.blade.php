<?php
header ('Content-type: text/html; charset=UTF-8');
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-user"></i>
            Acessos por usuário
        </h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div id="grafico" name="grafico">
        </div>
    </div>

    <div class="box-body">
        <canvas id="grafico2" height="400">
        </canvas>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script>
var area = new Morris.Bar({
    element: 'grafico',
    resize: true,
    data:   [
            @foreach($usuarios as $usuario)
                {{$usuario->virgula}} {y: "{{$usuario->login_usuario}}", item1: {{$usuario->mes}} }
            @endforeach
            ],
    xkey: 'y',
    ykeys: ['item1'],
    labels: ['Item 1'],
    lineColors: ['#a0d0e0'],
    hideHover: 'auto'
    });
</script>

<script>

    $("canvas").each(function(i,el){
        // Configurar a altura e largura do elemento canvas igual a do elemento pai.
        // O elemento pai é a div.canvas-container
        $(el).attr({
            "width":$(el).parent().width(),
            //"height":$(el).parent().outerHeight()
        });
    });

    var data = {
        labels: [
                    @foreach($usuarios as $usuario)
                        {{$usuario->virgula}} "{{$usuario->login_usuario}}"
                    @endforeach
                ],
        datasets: [{
            label: "My First dataset",
            fillColor: "#a0d0e0",
            strokeColor: "#a0d0e0",
            pointColor: "#a0d0e0",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#a0d0e0)",
            data: [
                @foreach($usuarios as $usuario)
                    {{$usuario->virgula}} {{$usuario->mes}}
                @endforeach
            ]
        }]
    };

    var options = {
        responsive: true
    };


    var ctx = document.getElementById('grafico2').getContext('2d');
    var myChart = new Chart(ctx).Bar(data, options);
</script>

