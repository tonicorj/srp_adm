{!! Form::hidden('ID_JOGADOR', null, ['class'=>'form-control input-sm', 'id'=>'ID_JOGADOR']) !!}

<div class="table">
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Dados do Jogador
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-8">
                            {!! Form::label('jog_nome_apelido', 'Apelido') !!}
                            {!! Form::label ('JOG_NOME_APELIDO', $jogador->JOG_NOME_APELIDO, ['class'=>'form-control input-sm']) !!}
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('jog_dt_nascimento', 'Data de Nascimento') !!}
                            <label class="control-label form-control input-sm">{!! data_display($jogador->JOG_DT_NASCIMENTO) !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            {!! Form::label('jog_nome_completo', 'Nome Completo') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_NOME_COMPLETO !!}</label>
                       </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            {!! Form::label('jog_posicao', 'Posição') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_POSICAO !!}</label>
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('jog_pos_alternativa', 'Posição Alternativa') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_POS_ALTERNATIVA !!}</label>
                        </div>
                        <div class="form-group col-lg-4">
                            {!! Form::label('jog_pe_dominante', 'Pé Dominante') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_PE_DOMINANTE !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_manequim', 'Manequim') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_MANEQUIM !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_peso', 'Peso') !!}
                            <label class="control-label form-control input-sm">{!! number_format($jogador->JOG_PESO, 2 ) !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_num_pe', 'No.Pé') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_NUM_PE !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('jog_altura', 'Altura') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_ALTURA !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('id_pais', 'País Natal') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->PAIS_NOME !!}</label>
                        </div>
                        <div class="form-group col-lg-7">
                            {!! Form::label('id_cidade_natal', 'Cidade Natal') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->CIDADE_NATAL !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('id_escolaridade', 'Escolaridade') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->ESCOLARIDADE !!}</label>
                        </div>
                        <div class="form-group col-lg-5">
                            {!! Form::label('jog_estado_civil', 'Estado Civil') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->ESTADO_CIVIL !!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-clube">
                        <div class="panel-heading">Foto</div>
                        <div class="panel-body">
                            <img class="displayed center-block" src="{{$jogador->FOTO}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-clube">
                        <div class="panel-heading">
                            Registros
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                {!! Form::label('JOG_CBF', 'CBF') !!}
                                <label class="control-label form-control input-sm">{!! $jogador->JOG_CBF !!}</label>
                            </div>
                            <div class="form-group col-lg-6">
                                {!! Form::label('JOG_REG_ESTADUAL', 'Estadual') !!}
                                <label class="control-label form-control input-sm">{!! $jogador->JOG_REG_ESTADUAL !!}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Dados da Filiação
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('jog_nome_pai', 'Nome do Pai') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_NOME_PAI !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('jog_documento_pai', 'Documentos Pai') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_DOCUMENTOS_PAI !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('jog_nome_mae', 'Nome da Mãe') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_NOME_MAE !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('jog_documento_mae', 'Documentos Mãe') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_DOCUMENTOS_MAE !!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($id_categoria <> 1)
        <div class="row">
            <div class="col-lg-11">
                <div class="panel panel-clube">
                    <div class="panel-heading">
                        Responsável Legal
                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-lg-5">
                                {!! Form::label('JOG_RESPONSAVEL_LEGAL', 'Nome') !!}
                                <label class="control-label form-control input-sm">{!! $jogador->JOG_RESPONSAVEL_LEGAL !!}</label>
                            </div>
                            <div class="form-group col-lg-2 checkbox" >
                                <br>
                                <label>
                                {!! Form::checkbox('RESP_LEGAL_TUTOR', null,
                                    ['class'=>'flat-red'
                                    , 'id'=>'RESP_LEGAL_TUTOR'
                                    , 'disable' => ''
                                    ]) !!}
                                Tutor
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-7">
                                {!! Form::label('JOG_CUIDADOR_ENDERECO', 'Endereço') !!}
                                <label class="control-label form-control input-sm">{!! $jogador->JOG_CUIDADOR_ENDERECO !!}</label>
                            </div>
                            <div class="form-group col-lg-3">
                                {!! Form::label('JOG_CUIDADOR_TELEFONE', 'Telefone') !!}
                                <label class="control-label form-control input-sm">{!! $jogador->JOG_CUIDADOR_TELEFONE !!}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Documentos
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_IDENTIDADE', 'Identidade') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_IDENTIDADE !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_IDENTIDADE_EMISSAO', 'Emissão') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_IDENTIDADE_EMISSAO !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_IDENTIDADE_VENCIMENTO', 'Vencimento') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_IDENTIDADE_VENCIMENTO !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_CPF', 'CPF') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_CBF !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_PIS', 'PIS') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_PIS !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_CARTEIRA_TRABALHO', 'Carteira de Trabalho') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_CARTEIRA_TRABALHO !!}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_CERTIFICADO_MILITAR', 'Certificado Militar') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_CERTIFICADO_MILITAR !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_RA', 'RA(Pedagogia)') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_RA !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_TITULO_ELEITOR', 'Título de Eleitor') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_TITULO_ELEITOR !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('JOG_ZONA', 'Zona') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_ZONA !!}</label>
                        </div>
                        <div class="form-group col-lg-1">
                            {!! Form::label('JOG_SECAO', 'Seção') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_SECAO !!}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('CERT_CARTORIO', 'Certidão Nascimento - Cartório') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->CERT_CARTORIO !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('CERT_LIVRO', 'Livro') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->CERT_LIVRO !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('CERT_TERMO', 'Termo') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->CERT_TERMO !!}</label>
                        </div>
                        <div class="form-group col-lg-2">
                            {!! Form::label('CERT_FOLHA', 'Folha') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->CERT_FOLHA !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_PASSAPORTE', 'Passaporte') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_PASSAPORTE !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_PASSAPORTE_EMISSAO', 'Emissão') !!}
                            <label class="control-label form-control input-sm">{!! data_display($jogador->JOG_PASSAPORTE_EMISSAO) !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_PASSAPORTE_VENCIMENTO', 'Vencimento') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_PASSAPORTE_VENCIMENTO !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_VISTO_NUMERO', 'Visto de Trabalho') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_VISTO_NUMERO !!}</label>
                        </div>
                        <div class="form-group col-lg-3">
                            {!! Form::label('JOG_VISTO_VENCIMENTO', 'Vencimento') !!}
                            <label class="control-label form-control input-sm">{!! data_display($jogador->JOG_VISTO_VENCIMENTO) !!}</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Dados Bancários
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-4">
                        {!! Form::label('JOG_BANCO_NOME', 'Banco') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BANCO_NOME !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_BANCO_AGENCIA', 'Agência') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BANCO_AGENCIA !!}</label>
                    </div>
                    <div class="form-group col-lg-3">
                        {!! Form::label('JOG_BANCO_CONTA', 'Conta') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BANCO_CONTA !!}</label>
                    </div>
                    <div class="form-group col-lg-3">
                        {!! Form::label('JOG_BANCO_TIPO_CONTA', 'Tipo de Conta') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BANCO_TIPO_CONTA !!}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Plano de Saúde
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-6" >
                            {!! Form::label('JOG_NOME_PLANO_SAUDE', 'Nome do Plano de Saúde') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_NOME_PLANO_SAUDE !!}</label>
                        </div>
                        <div class="form-group col-lg-5" >
                            {!! Form::label('JOG_PLANO_SAUDE', 'Número do Cartão') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_PLANO_SAUDE !!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Endereço 1
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-6">
                        {!! Form::label('JOG_ENDERECO', 'Endereço 1') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_ENDERECO !!}</label>
                    </div>
                    <div class="form-group col-lg-5">
                        {!! Form::label('JOG_BAIRRO', 'Bairro') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BAIRRO !!}</label>
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('id_cidade', 'Cidade') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->CIDADE_NOME !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_CEP', 'CEP') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_CEP !!}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Endereço 2
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-6">
                        {!! Form::label('JOG_ENDERECO2', 'Endereço 2') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_ENDERECO2 !!}</label>
                    </div>
                    <div class="form-group col-lg-5">
                        {!! Form::label('JOG_BAIRRO2', 'Bairro') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_BAIRRO2 !!}</label>
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('id_cidade2', 'Cidade') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->CIDADE_NOME2 !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_CEP2', 'CEP') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_CEP2 !!}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Contatos
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group col-lg-4">
                        {!! Form::label('JOG_REFTEL1', 'Referência 1') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_REFTEL1 !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_TEL1', 'Telefone 1') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_TEL1 !!}</label>
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::label('JOG_REFTEL2', 'Referência 2') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_REFTEL2 !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_TEL2', 'Telefone 2') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_TEL2 !!}</label>
                    </div>

                    <div class="form-group col-lg-4">
                        {!! Form::label('JOG_REFTEL3', 'Referência 3') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_REFTEL3 !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_TEL3', 'Telefone 3') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_TEL3 !!}</label>
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::label('JOG_REFTEL4', 'Referência 4') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_REFTEL4 !!}</label>
                    </div>
                    <div class="form-group col-lg-2">
                        {!! Form::label('JOG_TEL4', 'Telefone 4') !!}
                        <label class="control-label form-control input-sm">{!! $jogador->JOG_TEL4 !!}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-clube">
                <div class="panel-heading">
                    Outros Dados
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-lg-5">
                            {!! Form::label('jog_origem', 'Origem') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->JOG_ORIGEM !!}</label>
                        </div>
                        <div class="form-group col-lg-1"></div>
                        <div class="form-group col-lg-5">
                            {!! Form::label('id_parceiro', 'Parceiro') !!}
                            <label class="control-label form-control input-sm">{!! $jogador->PARCEIRO !!}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
