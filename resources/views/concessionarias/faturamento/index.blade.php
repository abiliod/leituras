@extends('layouts._gynPromo.app')

@section('content')
    <div class="container">
        <h2 class="center">Faturamento de Contas </h2>
        <div class="row">
            <form action="{{route('concessionarias.faturamento.searchFaturas')}}" method="post">
                @CSRF
                <div class="input-field col m4 s12">
                    <select name="status_fatura" id="status_fatura" >
                        <option value="00" selected>Selecione</option>
                        <option value="Pendente" >Pendente</option>
                        <option value="Pago">Pago</option>
                    </select>
                    <label for="status_fatura">Status de Pagamento</label>
                </div>

                <div class="input-field col m4 s12">
                    <select name="tipo_concessionaria" id="tipo_concessionaria">
                        <option value="00" selected>Selecione</option>
                        <option value="Energia">Energia</option>
                        <option value="Agua">Água</option>
                    </select>
                    <label for="tipo_concessionaria">Tipo de Concessionaria</label>
                </div>

                <div class="input-field col m4 s12">
                    <input id="cod_medidor" type="text"  name="cod_medidor"  value="">
                    <label for="cod_medidor" class="active">Código do Medidor</label>
                </div>

                <div class="input-field col m8 s12">
                    <input id="descricao" type="text"  name="descricao"  value="">
                    <label for="descricao">
                        Apenas pela Descrição vai imprimir somente status pendente, não precisa selecionar status
                    </label>
                </div>

                <div class="input-field col m4 s12">
                    <button  id="btnFiltrar" class="btn defaut left">Filtrar</button>
                </div>

            </form>
        </div>


        <div class="row">
            <nav>
                <div class="nav-wrapper green">
                    <div class="col s12">
                        <a href="{{ route('home')}}" class="breadcrumb">Início</a>
                        <a class="breadcrumb">Faturamento</a>
                    </div>
                </div>
            </nav>
        </div>


    <div class="row">
        <table class="col s12">
            <thead>
            <tr>
                <th>imagem</th>
                <th>Tipo Concessionária</th>
                <th>Código do Medidor</th>
                <th>Qtd.Dias</th>
                <th>Data Vencimento</th>
                <th>Descrição</th>
                <th>Consumo</th>
                <th>Valor Medido</th>
                <th>TUSD.</th>
                <th>Outros Add.</th>
                <th>Total Outros Add.</th>
                <th>Total Geral</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>
            @forelse($registros as $registro)
                <tr>
                    <td>
                        @if(isset($registro->imagem))
                            <img  width="60" src="{{ asset( $registro->imagem ) }}">
                        @endif
                    </td>
                    <td>{{ $registro->tipo_concessionaria }}</td>
                    <td>{{ $registro->cod_medidor }}</td>
                    <td>{{ $registro->dias }}</td>
                    <td>{{ isset($registro->data_vencimento) ?  date( 'd/m/Y' , strtotime($registro->data_vencimento)) : '' }}</td>
                    <td>{{ $registro->descricao }}</td>
                    <td>{{ $registro->consumo }}</td>
                    <td>{{  'R$'.number_format($registro->valor_consumo, 2, ',', '.') }}</td>
                    <td>{{  'R$'.number_format($registro->rateio_fixo, 2, ',', '.') }}</td>
                    <td>{{ $registro->tipo_custo_adicional }}</td>
                    <td>{{  'R$'.number_format($registro->custo_adicional, 2, ',', '.') }}</td>
                    <td>{{  'R$'.number_format($registro->custo_adicional + $registro->valor_consumo + $registro->rateio_fixo, 2, ',', '.') }}</td>
                    <td>
                        @If ($registro->status_fatura=='Pago')
                            <a class="waves-effect waves-light btn green"
                               href="{{ route('concessionarias.faturamento.imprimirFatura',$registro->id) }}">Imprimir</a>
                            <a class="waves-effect waves-light btn orange"
                               href="{{ route('concessionarias.faturamento.imprimirFatura',$registro->id) }}" disabled> Editar </a>
                            <a class="waves-effect waves-light btn blue"
                               href="{{ route('concessionarias.faturamento.receberFatura',$registro->id) }}" disabled >Receber</a>
                            <a class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('concessionarias.leituras.destroyLeituras',$registro->id) }}' }  " disabled >Deletar</a>
                        @Else
                            <a class="waves-effect waves-light btn green"
                               href="{{ route('concessionarias.faturamento.pdffatura',$registro->id) }}">Imprimir</a>
                            <a class="waves-effect waves-light btn orange"
                               href="{{ route('concessionarias.faturamento.imprimirFatura',$registro->id) }}">Editar</a>
                            <a class="btn blue" href="javascript: if(confirm('Receber essa Fatura?')){ window.location.href = '{{ route('concessionarias.faturamento.recebimentoFatura',$registro->id) }}' }">Receber</a>
                            <a class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('concessionarias.faturamento.destroyFatura',$registro->id) }}' }">Deletar</a>
                        @Endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td> Não há Registros </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="row">
            {!! $registros->links() !!}
        </div>
    </div>

    </div>
@endsection
