<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-12" name="total_mes" id="total_mes">
        <script type="text/javascript">
            $("#total_mes").load( '{{ route('log.total_mes')  }}');
        </script>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-12" name="usuarios_mes" id="usuarios_mes">
        <script type="text/javascript">
            $("#usuarios_mes").load( '{{ route('log.usuarios_mes')  }}');
        </script>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-12" name="usuarios_unicos" id="usuarios_unicos">
        <script type="text/javascript">
            $("#usuarios_unicos").load( '{{ route('log.usuarios_unicos')  }}');
        </script>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-12" name="departamentos_unicos" id="departamentos_unicos">
        <script type="text/javascript">
            $("#departamentos_unicos").load( '{{ route('log.departamentos_unicos')  }}');
        </script>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <div class="col-lg-3" name="categorias_jogadores" id="categorias_jogadores">
        <script type="text/javascript">
            $("#categorias_jogadores").load( '{{ route('categorias.jogadores')  }}');
        </script>
    </div>
    <div class="col-lg-3" name="categorias_dm_mes" id="categorias_dm_mes">
        <script type="text/javascript">
            $("#categorias_dm_mes").load( '{{ route('categorias.dm_mes')  }}');
        </script>
    </div>
    <div class="col-lg-3" name="categorias_ocorrencias" id="categorias_ocorrencias">
        <script type="text/javascript">
            $("#categorias_ocorrencias").load( '{{ route('categorias.ocorrencias')  }}');
        </script>
    </div>
    <div class="col-lg-3" name="categorias_prep_fisica" id="categorias_prep_fisica">
        <script type="text/javascript">
            $("#categorias_prep_fisica").load( '{{ route('categorias.prep_fisica')  }}');
        </script>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <div class="col-lg-12" name="categorias_contratos_g" id="categorias_contratos_g">
        <script type="text/javascript">
            $("#categorias_contratos_g").load( '{{ route('categorias.contratos_g')  }}');
        </script>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-12" name="assistencia_social" id="assistencia_social">
        <script type="text/javascript">
            $("#assistencia_social").load( '{{ route('categorias.assistencia_social')  }}');
        </script>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-12" name="pedagogia" id="pedagogia">
        <script type="text/javascript">
            $("#pedagogia").load( '{{ route('categorias.pedagogia')  }}');
        </script>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-12" name="fisioterapia" id="fisioterapia">
        <script type="text/javascript">
            $("#fisioterapia").load( '{{ route('categorias.fisioterapia')  }}');
        </script>
    </div>
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <div class="col-lg-3" name="categorias_qts" id="categorias_qts">
        <script type="text/javascript">
            $("#categorias_qts").load( '{{ route('categorias.qts')  }}');
        </script>
    </div>

    <div class="col-lg-3" name="categorias_jogos" id="categorias_jogos">
        <script type="text/javascript">
            $("#categorias_jogos").load( '{{ route('categorias.jogos')  }}');
        </script>
    </div>

    <div class="col-lg-3" name="categorias_jogos_jogadores" id="categorias_jogos_jogadores">
        <script type="text/javascript">
            $("#categorias_jogos_jogadores").load( '{{ route('categorias.jogos_jogadores')  }}');
        </script>
    </div>

    <div class="col-lg-3" name="categorias_concentracoes" id="categorias_concentracoes">
        <script type="text/javascript">
            $("#categorias_concentracoes").load( '{{ route('categorias.concentracoes')  }}');
        </script>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
