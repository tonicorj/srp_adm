{!! Form::hidden('ID_JOGADOR', null, ['class'=>'form-control input-sm', 'id'=>'ID_JOGADOR']) !!}

<div class="table">
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Dados do Jogador
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::label('jog_nome_apelido', 'Apelido') !!}
                            {!! Form::label ('JOG_NOME_APELIDO', $contrato->JOG_NOME_APELIDO, ['class'=>'form-control input-sm']) !!}
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_dt_nascimento', 'Data de Nascimento') !!}
                            <label class="control-label form-control input-sm">{!! data_display($contrato->JOG_DT_NASCIMENTO) !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_posicao', 'Posição') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->JOG_POSICAO !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            {!! Form::label('jog_nome_completo', 'Nome Completo') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->JOG_NOME_COMPLETO !!}</label>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Foto</div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Registros
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                {!! Form::label('JOG_CBF', 'CBF') !!}
                                <label class="control-label form-control input-sm">{!! $contrato->JOG_CBF !!}</label>
                            </div>
                            <div class="form-group col-lg-6">
                                {!! Form::label('JOG_REG_ESTADUAL', 'Estadual') !!}
                                <label class="control-label form-control input-sm">{!! $contrato->JOG_REG_ESTADUAL !!}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Vínculos
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('tipo_contrato_descricao', 'Tipo de Contrato') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->TIPO_CONTRATO_DESCRICAO!!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('relacao_nome', 'Relação') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->relacao_nome !!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Vigência
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-2">
                            {!! Form::label('cont_dt_inicio', 'Data Inicial') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_DT_INICIO!!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('cont_dt_final', 'Data Final') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_DT_FINAL!!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('cont_dt_prorrogacao', 'Prorrogação') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_DT_PRORROGACAO!!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('cont_dt_rescicao', 'Rescisão') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_DT_RESCICAO!!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Representante
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-11">
                            {!! Form::label('CONT_PJ_NOME', 'Pessoa Jurídica') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_PJ_NOME!!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                                {!! Form::label('CONT_REPR_EMAIL', 'E-mail') !!}
                                <label class="control-label form-control input-sm">{!! $contrato->CONT_REPR_EMAIL!!}</label>
                        </div>
                        <div class="form-group col-lg-5">
                            {!! Form::label('CONT_REPR_TELEFONE', 'Telefone') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_REPR_TELEFONE!!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Valores
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_SALARIO', 'Salário') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_SALARIO!!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_DIREITO_IMAGEM', 'Direito de Imagem') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_DIREITO_IMAGEM!!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_BOLSA', 'Bolsa') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_BOLSA!!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_AUXMORADIA', 'Auxílio Moradia') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_AUXMORADIA!!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_AUXALIMENTACAO', 'Auxílio Alimentação') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_AUXALIMENTACAO!!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_AUXTRANSPORTE', 'Auxílio Transporte') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_AUXTRANSPORTE!!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_LUVAS', 'Luvas') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_LUVAS!!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('CONT_VL_EXTRAS', 'Extras') !!}
                            <label class="control-label form-control input-sm">{!! $contrato->CONT_VL_EXTRAS!!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
