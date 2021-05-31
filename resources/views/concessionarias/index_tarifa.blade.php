@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Concessionarias  Tarifas </h2>
	    <div class="row">
			<div class="nav-wrapper green">
               <form action="{{route('concessionarias.tarifas.searchTarifa')}}" method="post">
					@csrf
                    <div class="input-field col m3 s12">
                        <select name="tipo_concessionaria" >

                        <option value="Energia">Energia</option>
                        <option value="Agua">Água</option>
                        </select>
                        <label>Tipo de Concessionaria</label>
                    </div>
                    <div class="input-field col m3 s12">
                        <select name="tipo_consumidor" >
                        <option value="Comercial">Comercial</option>
                        <option value="Residencial">Residencial</option>
                        <option value="Rural">Rural</option>
                        <option value="Social">Social</option>
                        </select>
                        <label>Tipo de Consumo</label>
                    </div>
                    <div class="input-field col m4 s12">
	                    <input id="search" type="date"  name="search"  value="">
                        <label class="active">Inicio da Vigência</label>
                    </div>

                    <div class="input-field col m2 s12">
                         <button  id="btnFiltrar" class="btn defaut left">Filtrar</button>
                    </div>
				</form>
		    </div>
		<div class="row">
		</div>
        <nav>
			<div class="nav-wrapper green">
				<div class="col s12">
					<a href="{{ route('home')}}" class="breadcrumb">Início</a>
					<a class="breadcrumb">Unidades Consumidoras</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row">
		<table>
				<thead>
					<tr>
                        <th>Concessionaria</th>
						<th>Consumidor</th>
                        <th>Custo Fixo</th>
                        <th>Tipo Custo Unitário</th>
                        <th>Custo Unitário</th>
                        <th>Tipo Custo Adicional</th>
                        <th>Custo Adicional</th>
                        <th>Vigência</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
                @forelse($registros as $registro)
                <tr>
                    <td>{{ $registro->tipo_concessionaria }}</td>
                    <td>{{ $registro->tipo_consumidor }}</td>
                    <td>{{    'R$ '.number_format($registro->custo_fixo , 5, ',', '.') }} </td>

                    <td>{{ $registro->tipo_custo_unitario }}</td>

                    <td>{{    'R$ '.number_format($registro->custo_unitario , 5, ',', '.') }}</td>
                    <td>{{ $registro->tipo_custo_adicional }}</td>

                    <td>{{    'R$ '.number_format($registro->custo_adicional , 5, ',', '.') }}</td>

                    <td>{{ date( 'd/m/Y' , strtotime($registro->vigencia))}}</td>

                    <td>
                        <a disabled="true"  class="waves-effect waves-light btn orange"
                            href="#">Editar</a>  <!----  route('concessionarias.tarifas.editarTarifa',$registro->id)  -->
                        <a disabled="true" class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('concessionarias.contas.destroyTarifas',$registro->id) }}' }">Deletar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td> Não há Registros </td>
                    <td> <a class="btn blue" href="{{route('concessionarias.tarifas.adicionarTarifas')}}">Adicionar</a> </td>

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
