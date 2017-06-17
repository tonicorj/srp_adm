<?php
header ('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SADE - ADM</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

        <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">                               <!-- Bootstrap 3.3.6 -->
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">   <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">       <!-- Ionicons -->


        <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css')}}">                   <!-- DataTables -->
        <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css')}}">                                     <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/_all-skins.min.css')}}">                             <!-- AdminLTE Skins. Choose a skin from the css/skins
                                                                                                                             folder instead of downloading all of them to reduce the load. -->
        <script src="{{ URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>                                   <!-- jQuery 2.2.3 -->

        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>                                      <!-- jQuery UI 1.11.4 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>                     <!-- Morris.js charts -->

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>

        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
        <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>

        <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>                                        <!-- Bootstrap 3.3.6 -->

        <script src="{{ URL::asset('dist/js/app.min.js')}}"></script>                                                   <!-- AdminLTE App -->
        <script src="{{ URL::asset('dist/js/demo.js')}}"></script>                                                      <!-- AdminLTE for demo purposes -->
        <script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>          <!-- Bootstrap WYSIHTML5 -->

        <script src="{{ URL::asset('plugins/morris/morris.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>                               <!-- Sparkline -->
        <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>                    <!-- jvectormap -->
        <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script >
        <script src="{{ URL::asset('plugins/knob/jquery.knob.js')}}"></script>                                          <!-- jQuery Knob Chart -->
        <script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>                          <!-- Slimscroll -->
        <script src="{{ URL::asset('plugins/fastclick/fastclick.js')}}"></script>                                       <!-- FastClick -->

        <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>                          <!-- DataTables -->
        <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

        <!--
        <script src="{{ URL::asset('dist/js/pages/dashboard.js')}}"></script>                                           <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    </head>

<body class="hold-transition skin-blue sidebar-mini">
   
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SADE - ADM</b></span>
        </a>
    
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <!--
                            <span class="label label-warning">10
                            </span>
                            -->
                        </a>
                        <!--
                        <ul class="dropdown-menu">
                            <li class="header">Você tem 10 notificações</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 1a notificação
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> 2a notificação
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 3a notificação
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 4a notificação
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> 5a notificação
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                        -->
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <!--<span class="label label-danger">5</span>-->
                        </a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel" align=center name="escudo" id="escudo">
                <script type="text/javascript">
                    $("#escudo").load('{{ route('parametros.escudo')  }}');
                </script>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Menu Opções</li>
                <li class="active treeview">
                    <a href="\">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Acessos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="{{ route('log.usuarios_acessos')}}"><i class="fa fa-circle-o"></i> por Usuários</a></li>
                        <li><a href="{{ route('log.departamentos_acessos')}}"><i class="fa fa-circle-o"></i> por Departamentos</a></li>
                    </ul>
                </li>

            </ul>
        </section>
    </aside>

    <canvas id="myChart" width="400" height="400">
    </canvas>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Content Wrapper. Contains page content
    <div class="content-wrapper">
        @yield('content')
    </div>



    @include('footer')
    -->

</div>
<!-- ./wrapper -->
</body>

</html>

<!-- page script -->
<script>
    $(function () {
        $('#tabela2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false
        });
    });
</script>
