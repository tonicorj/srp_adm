@extends('template')

@section('content')

    <section class="content-header">
        <h1>Jogadores</h1>
        <ol class="breadcrumb">
            <li><a href="\"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Contratos</li>
            <li class="active">Contrato</li>
        </ol>
    </section>
    <div class="content">
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(
            [ 'id'=>'form_'
            , 'data-toggle'=>"validator"
            , 'role'=>"form"
            , 'files' => true
            ]) !!}
            @include ('contratos._form')
        {!! Form::close() !!}

        <script>
            function voltar(){
                location.href="{{ asset('jogadores') }}";
            }
            // rotina que chama o endereço para inclusão, passando o form como parametros
        </script>
    </div>
@stop