<?php
header ('Content-type: text/html; charset=UTF-8');
?>
    <div class="info-box bg-aqua col-lg-3 col-xs-12">
        <span class="info-box-icon"><i class="glyphicon user_add"></i></span>
        <div class="info-box-content">
            <h3>{{$atletas_chegaram}}</h3>
            <span class="info-box-text">Chegaram</span>
        </div>
        <!-- /.info-box-content -->
    </div>

    <div class="info-box bg-red col-lg-3 col-xs-12">
        <span class="info-box-icon"><i class="fa fa fa-user-o"></i></span>
        <div class="info-box-content">
            <h3>{{$atletas_sairam}}</h3>
            <span class="info-box-text">Saíram</span>
        </div>
        <!-- /.info-box-content -->
    </div>

<!-- /.info-box -->