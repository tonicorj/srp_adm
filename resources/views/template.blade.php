<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SADE ADM</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load.
    <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/skin-black.css') }}">
    -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/_all-skins.min.css') }}">



    <!-- jQuery 2.2.3 -->
    <script src="{{ URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

    <!-- outros -->
    <script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('dist/js/pages/dashboard.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

    <header class="main-header bg-clube-active">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">SADE</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SADE</b> Admin</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <!-- Single button -->
                <ul class="nav navbar-nav">
                    <!-- Calendário -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ Auth::user()['config']->mes }}/{{ Auth::user()['config']->ano }}
                        </a>
                    </li>
                    <!-- end Calendário -->

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-success">{{ $avisos['avisos_ocorrencias'] }}</span>
                        </a>
                        @if ($avisos['avisos_ocorrencias'] >= 0)
                            <ul class="dropdown-menu">
                                <li class="header">Últimas {{$avisos['avisos_ocorrencias']}} ocorrências</li>
                                <li>
                                    <ul class="menu">
                                        @foreach( $avisos['ocorrencias'] as $ocorrencia )
                                            <li>
                                                <a href="#">
                                                    @if ($ocorrencia->OCORR_TIPO == 1 ) <i class="fa fa-exclamation text-aqua"></i>
                                                    @elseif ($ocorrencia->OCORR_TIPO == 2 ) <i class="fa fa-exclamation-triangle text-yellow"></i>
                                                    @elseif ($ocorrencia->OCORR_TIPO == 3 ) <i class="fa fa-exclamation-circle text-red"></i>
                                                    @elseif ($ocorrencia->OCORR_TIPO == 4 ) <i class="fa fa-warning text-yellow"></i>
                                                    @else    <i class="fa fa-warning text-red"></i> @endif
                                                    {{ data_display($ocorrencia->OCORR_DATA)}} - {{ $ocorrencia->JOG_NOME_APELIDO }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        @endif
                    </li>
                    <!-- end Notificacoes -->

                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <!--<span class="label label-danger">5</span>-->
                        </a>
                    </li>

                    <!-- troca de categoria -->
                    <li class="dropdown tasks-menu">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           role="button"
                           aria-expanded="false">Categorias <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach( Auth::user()->categorias() as $categ )
                                <li>
                                    <a href="#" onclick="mudaCategoria({{$categ->id_categoria}}, '{{$categ->categ_descricao}}');">
                                        {{$categ->categ_descricao}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li> -->

                    <!-- logout -->
                    <li>
                        <a href="{{ url('/logout') }}" class="btn btn-danger fa fa-sign-out">
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{!! asset('imagens/logo.bmp') !!}" class="img-circle" alt="Cliente">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <div id="_categoria">
                        {{Auth::user()->categoria_descricao()}}
                    </div>
                </div>
            </div>

            <!-- Sidebar user panel -->
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="\">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('dashboard.index')}}"><i class="fa fa-dashboard"></i>Principal</a></li>
                        <li><a href="{{ route('dashboard.jogadores')}}"><i class="fa fa-users"></i>Jogadores</a></li>
                        <li><a href="{{ route('dashboard.depfutebol')}}"><i class="fa fa-building"></i>Dep.Futebol</a></li>
                        <li><a href="{{ route('dashboard.depmedico')}}"><i class="fa fa-medkit"></i>Dep.Médico</a></li>
                        <li><a href="{{ route('dashboard.admin')}}"><i class="fa fa-briefcase"></i>Administrativo</a></li>
                    </ul>
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
                    <!--
                        <li><a href="{{ route('dashboard.usuarios_acessos')}}"><i class="fa fa-circle-o"></i>por Usuários</a></li>
                        <li><a href="{{ route('dashboard.departamentos_acessos')}}"><i class="fa fa-circle-o"></i>por Departamentos</a></li>
                        -->
                        <li><a href="{{ route('dashboard.acessosdep')}}"><i class="fa fa-building"></i>Departamentos</a></li>
                        <li><a href="{{ route('dashboard.acessos')}}"><i class="fa fa-sign-in"></i>Outros Acessos</a></li>
                        <li><a href="{{ route('jogadores.por_posicao')}}"><i class="fa fa-sign-in"></i>Por Posição</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('footer')

</div>
<!-- ./wrapper -->

<script>
    function mudaCategoria(id_categoria, descricao) {
        _url = '{{asset("config/altera_categoria")}}/' + id_categoria;
        //alert(_url);
        $.ajax({
            url: _url,
            type: 'GET',
            dataType: 'html',
            encode: true,
            data: {id: id_categoria, _token: $("#_tokenSearch").val()},
            success: function (data) {
                $("#_categoria").html('');
                $("#_categoria").append(data);
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
</script>

</body>
</html>
