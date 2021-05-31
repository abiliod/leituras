<div class="row">
    <div class="col s12">
        <h6 class="header center">Dados do Cliente</h6>
        <div class="input-field col m6 s12">
          <input placeholder="CPF/CNPJ" id="pessoa_cpfcnpj" type="text" class="validate"
          value="{{ isset($registro->pessoa_cpfcnpj) ? $registro->pessoa_cpfcnpj : '' }}">
          <label for="pessoa_cpfcnpj">CPF/CNPJ:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="status" id="status" type="text" class="validate"
          value="{{ isset($registro->status) ? $registro->status : '' }}">
          <label for="status">Status:</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h6 class="header center">Dados da Tarifa</h6>
        <div class="input-field col m6 s12">
          <input placeholder="custo_fixo" id="custo_fixo" type="text" class="validate"
          value="{{  'R$ '.number_format($registro->custo_fixo, 2, ',', '.') }}">
          <label for="custo_fixo">Custo Fixo:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="Ativo" id="custo_unitario" type="text" class="validate"
            value="{{  'R$ '.number_format($registro->custo_unitario, 2, ',', '.') }}">
          <label for="custo_unitario">Custo Por Unidade de Consumo:</label>
        </div>


        <div class="input-field col m6 s12">
          <input placeholder="vigencia_tarifa" id="vigencia_tarifa" type="text" class="validate"
          value="{{ isset($registro->vigencia_tarifa) ? $registro->vigencia_tarifa : '' }}">
          <label for="vigencia_tarifa">Vigencia Inicial:</label>
        </div>


        <div class="input-field col m6 s12">
          <input placeholder="tipo_concessionaria" id="tipo_concessionaria" type="text" class="validate"
          value="{{ isset($registro->tipo_concessionaria) ? $registro->tipo_concessionaria : '' }}">
          <label for="tipo_concessionaria">Tipo de Consumo:</label>
        </div>


        <div class="input-field col m6 s12">
          <input placeholder="tipo" id="tipo" type="text" class="validate"
          value="{{ isset($registro->tipo) ? $registro->tipo : '' }}">
          <label for="tipo">Tipo de Consumidor:</label>
        </div>


        <div class="row">

            <div class="col m6 s12">
                @if(isset($registro->imagem))
                <img width="120" src="{{ asset( $registro->imagem ) }}">
                @endif
            </div>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="rateio_custo_fixo" id="rateio_custo_fixo" type="text" class="validate"
          value="{{ isset($registro->rateio_custo_fixo) ? $registro->rateio_custo_fixo : '' }}">
          <label for="rateio_custo_fixo">Custo Fixo Rateado Qtd. Consumidor:</label>
        </div>


        <div class="input-field col m6 s12">
          <input placeholder="rateio_fixo" id="rateio_fixo" type="text" class="validate"

          value="{{  'R$ '.number_format($registro->rateio_fixo, 2, ',', '.') }}">
          <label for="rateio_fixo">Valor do Rateio:</label>
        </div>




    </div>
</div>
<div class="row">
    <div class="col s12">
        <h6 class="header center">Local da Instalação</h6>

        <div class="input-field col m6 s12">
          <input placeholder="descricao" id="descricao" type="text" class="validate"
          value="{{ isset($registro->descricao) ? $registro->descricao : '' }}">
          <label for="descricao">Descrição:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="cep" id="cep" type="text" class="validate"
          value="{{ isset($registro->cep) ? $registro->cep : '' }}">
          <label for="cep">CEP:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="logradouro" id="logradouro" type="text" class="validate"
          value="{{ isset($registro->logradouro) ? $registro->logradouro : '' }}">
          <label for="logradouro">Logradouro:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="numero" id="numero" type="text" class="validate"
          value="{{ isset($registro->numero) ? $registro->numero : '' }}">
          <label for="numero">Número:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="complemento" id="complemento" type="text" class="validate"
          value="{{ isset($registro->complemento) ? $registro->complemento : '' }}">
          <label for="complemento">Complemento:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="bairro" id="bairro" type="text" class="validate"
          value="{{ isset($registro->bairro) ? $registro->bairro : '' }}">
          <label for="bairro">Bairro:</label>
        </div>
        <div class="input-field col m6 s12">
          <input placeholder="cidade" id="cidade" type="text" class="validate"
          value="{{ isset($registro->cidade) ? $registro->cidade : '' }}">
          <label for="cidade">Cidade:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="estado" id="estado" type="text" class="validate"
          value="{{ isset($registro->estado) ? $registro->estado : '' }}">
          <label for="estado">Estado:</label>
        </div>

    </div>
</div>
<div class="row">
    <div class="col s12">
        <h6 class="header center">Dados da Medição</h6>

        <div class="input-field col m6 s12">
          <input placeholder="cod_medidor" id="cod_medidor" type="text" class="validate"
          value="{{ isset($registro->cod_medidor) ? $registro->cod_medidor : '' }}">
          <label for="cod_medidor">Código do Medidor:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="dataLeituraAtual" id="dataLeituraAtual" type="text" class="validate"
          value="{{ isset($registro->dataLeituraAtual) ? $registro->dataLeituraAtual : '' }}">
          <label for="dataLeituraAtual">Data Leitura Atual:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="dataLeituraAnterior" id="dataLeituraAnterior" type="text" class="validate"
          value="{{ isset($registro->dataLeituraAnterior) ? $registro->dataLeituraAnterior : '' }}">
          <label for="dataLeituraAnterior">Data Leitura Anterior:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="dias" id="dias" type="text" class="validate"
          value="{{ isset($registro->dias) ? $registro->dias : '' }}">
          <label for="dias">Qtd. Dias:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="posicaoLeituraAnterior" id="posicaoLeituraAnterior" type="text" class="validate"
          value="{{ isset($registro->posicaoLeituraAnterior) ? $registro->posicaoLeituraAnterior : '' }}">
          <label for="posicaoLeituraAnterior">Posicao Leitura Anterior:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="posicaoLeituraAtual" id="posicaoLeituraAtual" type="text" class="validate"
          value="{{ isset($registro->posicaoLeituraAtual) ? $registro->posicaoLeituraAtual : '' }}">
          <label for="posicaoLeituraAtual">`Posicao Leitura Atual:</label>
        </div>

        <div class="input-field col m6 s12">
            <input placeholder="outros" id="outros" type="text" class="validate"
                   value="{{ isset($registro->tipo_custo_adicional) ? $registro->tipo_custo_adicional : '' }}">
            <label for="outros">Outros Custos Adicionais:</label>
        </div>

        <div class="input-field col m6 s12">
            <input placeholder="outroscustos" id="outroscustos" type="text" class="validate"
                   value="{{  'R$ '.number_format($registro->custo_adicional, 2, ',', '.') }}">
            <label for="outroscustos">`Outros Custos Adicionais:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="consumo" id="consumo" type="text" class="validate"
          value="{{ isset($registro->consumo) ? $registro->consumo : '' }}">
          <label for="consumo">Consumo:  </label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="valor_consumo" type="text" class="validate"
          value="{{  'R$ '.number_format($registro->valor_consumo, 2, ',', '.') }}">
          <label for="valor_consumo">Valor do Consumo: </label>
        </div>

    </div>
</div>
<div class="row">
    <div class="col s12">

        <h6 class="header center">Status da Fatura</h6>

        <div class="input-field col m6 s12">
          <input placeholder="valor" id="valor" type="text" class="validate"
          value="{{  'R$'.number_format($registro->custo_adicional + $registro->valor_consumo + $registro->rateio_fixo, 2, ',', '.') }}">

          <label for="data_vencimento">Valor da Conta:</label>
        </div>

        <div class="input-field col m6 s12">
          <input placeholder="data_vencimento" id="data_vencimento" type="text" class="validate"
          value="{{ isset($registro->data_vencimento) ? date( 'd/m/Y' , strtotime($registro->data_vencimento)) : '' }}">
          <label for="data_vencimento">Data Vencimento:

          </label>
        </div>


        <div class="input-field col m6 s12">
          <input name="status_fatura" type="text" class="validate"
          value="{{ isset($registro->status_fatura) ? $registro->status_fatura : '' }}">
          <label for="status_fatura">Status Pagamento:</label>
        </div>

        <div class="input-field col m6 s12">
          <input name="data_pagamento" type="date" class="validate"
          value="{{ isset($registro->data_pagamento) ?
            $registro->data_pagamento : '' }}">
          <label  class ="active" for="data_pagamento">Data do Pagamento:</label>
        </div>

    </div>
</div>
