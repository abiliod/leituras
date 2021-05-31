<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<head>
<meta charset="utf-8">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<title>{{ config('app.name', 'GynPromo') }}</title>
</head>
  <body>
  <div class="container">


    <ul class="collection with-header" style="list-style: none;">
        <li class="collection-header"><h5>Cliente</h5></li>
        <li class="collection-item">CPF/CNPJ: / Status: {{ isset($registro->status) ? $registro->status : '' }}</li>
    </ul>
    <ul class="collection with-header" style="list-style: none;">
        <li class="collection-header"><h5>Dados da Tarifa</h5></li>
        <li class="collection-item">Custo Fixo:  {{  'R$ '.number_format($registro->custo_fixo, 2, ',', '.') }} Custo Por Unidade de Consumo: {{  'R$ '.number_format($registro->custo_unitario, 2, ',', '.') }} Vigencia Inicial:  {{ isset($registro->vigencia_tarifa) ? date( 'd/m/Y' , strtotime($registro->vigencia_tarifa)) : '' }} </li>
        <li class="collection-item">Tipo de Consumo: {{ isset($registro->tipo_concessionaria) ? $registro->tipo_concessionaria : '' }} Tipo de Consumidor: {{ isset($registro->tipo) ? $registro->tipo : '' }}  </li>
    </ul>
    <ul class="collection with-header" style="list-style: none;">
        <li class="collection-header"><h5> Local da Instalação</h5></li>
        <li class="collection-item">Descrição: {{ isset($registro->descricao) ? $registro->descricao : '' }} </li>
        <li class="collection-item">Logradouro:
            {{ isset($registro->logradouro) ? $registro->logradouro : '' }} {{ isset($registro->numero) ? $registro->numero : '' }}
            {{ isset($registro->complemento) ? $registro->complemento : '' }} {{ isset($registro->bairro) ? $registro->bairro : '' }}
            {{ isset($registro->cidade) ? $registro->cidade : '' }}   {{ isset($registro->estado) ? $registro->estado : '' }}
            <br>CEP:  {{ isset($registro->cep) ? $registro->cep : '' }}
        </li>
    </ul>
    <ul class="collection with-header" style="list-style: none;">
        <li class="collection-header"><h5>Dados da Medição</h5></li>
        <li class="collection-item">
        @if(isset($registro->imagem))
            Medidor:

            <img src="{{ asset( $registro->imagem ) }}" style="width: 100px; height: 100px">
        @endif
        Código do Medidor:  {{ isset($registro->cod_medidor) ? $registro->cod_medidor : '' }} </li>
        <li class="collection-item">Data Leitura Atual: {{ isset($registro->dataLeituraAtual) ? date( 'd/m/Y' , strtotime($registro->dataLeituraAtual)) : '' }} Data Leitura Anterior: {{ isset($registro->dataLeituraAnterior) ? date( 'd/m/Y' , strtotime($registro->dataLeituraAnterior)) : '' }} Qtd. Dias: {{ isset($registro->dias) ? $registro->dias : '' }} </li>
        <li class="collection-item">Posicao Leitura Anterior: {{ isset($registro->posicaoLeituraAnterior) ? $registro->posicaoLeituraAnterior : '' }} Posicao Leitura Atual: {{ isset($registro->posicaoLeituraAtual) ? $registro->posicaoLeituraAtual : '' }}</li>
        <li class="collection-item">Consumo: {{ isset($registro->consumo) ? $registro->consumo : '' }} Valor do Consumo: {{  'R$ '.number_format($registro->valor_consumo, 2, ',', '.') }}</li>
    </ul>
    <ul class="collection with-header" style="list-style: none;">
        <li class="collection-header"><h5>Status da Fatura</h5></li>
        <li class="collection-item">Valor da Conta:  {{  'R$ '.number_format($registro->valor_consumo + $registro->rateio_fixo, 2, ',', '.') }} </li>
        <li class="collection-item">Data Vencimento: {{ isset($registro->data_vencimento) ? date( 'd/m/Y' , strtotime($registro->data_vencimento)) : '' }} Status Pagamento: {{ isset($registro->status_fatura) ? $registro->status_fatura : '' }}</li>
        @if (isset($registro->data_pagamento))
            <li class="collection-item">Data do Pagamento: {{ isset($registro->data_pagamento) ? $registro->data_pagamento : '' }} </li>
        @endif
    </ul>
</div>
 <!--Import jQuery.js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="{{asset('js/init.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
