<?php
header ('Content-type: text/html; charset=UTF-8');
?>

<!--
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Contratos por Categoria</h3>
    </div>
    @foreach($categorias as $categoria)
        <div class="box-body">
            <div class="progress-group">
                <span class="progress-text">{{$categoria->categ_descricao}}</span>
                <span class="progress-number"><b>{{$categoria->qtd_contrato}}</b>/{{$categoria->qtd_jogadores}}</span>
                <div class="progress sm">
                    <div class="progress-bar {{$categoria->cor}}" style="width:{{$categoria->percentual}}%"></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
-->
<div class="box">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Contratos e Jogadores por Categoria</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-8">
                <canvas id="myChart" width="500" height="200"></canvas>
            </div>
            <div class="col-md-4">
                @foreach($categorias as $categoria)
                    <div class="box-body">
                        <div class="progress-group">
                            <span class="progress-text">{{$categoria->categ_descricao}}</span>
                            <span class="progress-number"><b>{{$categoria->qtd_contrato}}</b>/{{$categoria->qtd_jogadores}}</span>
                            <div class="progress sm">
                                <div class="progress-bar {{$categoria->cor}}" style="width:{{$categoria->percentual}}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    var data = {
        labels: [
            //"Sub 11", "Sub 13", "Sub 15", "Sub 17", "Sub 19", "Sub 21", "Profissional"
            @foreach($categorias as $categoria)
                "{{$categoria->categ_descricao}}",
            @endforeach
        ],
        datasets: [{
            label: "Contratos por categoria",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [
                @foreach($categorias as $categoria)
                    "{{$categoria->qtd_contrato}}",
                @endforeach
                ]
        }, {
            label: "Jogadores por Categoria",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [
                @foreach($categorias as $categoria)
                    "{{$categoria->qtd_jogadores}}",
                @endforeach
            ]
        }]
    };

    var options = {
        //Boolean - Whether to show lines for each scale point
        scaleShowLine : true,

        //Boolean - Whether we show the angle lines out of the radar
        angleShowLineOut : true,

        //Boolean - Whether to show labels on the scale
        scaleShowLabels : false,

        // Boolean - Whether the scale should begin at zero
        scaleBeginAtZero : true,

        //String - Colour of the angle line
        angleLineColor : "rgba(0,0,0,.1)",

        //Number - Pixel width of the angle line
        angleLineWidth : 1,

        //String - Point label font declaration
        pointLabelFontFamily : "'Arial'",

        //String - Point label font weight
        pointLabelFontStyle : "normal",

        //Number - Point label font size in pixels
        pointLabelFontSize : 10,

        //String - Point label font colour
        pointLabelFontColor : "#666",

        //Boolean - Whether to show a dot for each point
        pointDot : true,

        //Number - Radius of each point dot in pixels
        pointDotRadius : 3,

        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth : 1,

        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,

        //Boolean - Whether to show a stroke for datasets
        datasetStroke : true,

        //Number - Pixel width of dataset stroke
        datasetStrokeWidth : 2,

        //Boolean - Whether to fill the dataset with a colour
        datasetFill : true
    };

    var ctx = document.getElementById('myChart').getContext('2d');
    var myRadarChart = new Chart(ctx).Line(data, options);
</script>
