@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Concessionárias  Leituras </h2>
	    <div class="row">
			<div class="nav-wrapper green">
               <form action="{{route('concessionarias.leituras.searchLeituras')}}" method="post">
					@csrf
                    <div class="input-field col m3 s12">
                        <select name="tipo_concessionaria" >

                        <option value="Energia">Energia</option>
                        <option value="Agua">Água</option>
                        </select>
                        <label>Tipo de Concessionaria</label>
                    </div>
                    <div class="input-field col m4 s12">
	                    <input id="cod_medidor" type="text"  name="cod_medidor"  value="">
                        <label class="active">Código do Medidor</label>
                    </div>
                    <div class="input-field col m4 s12">
	                    <input id="search" type="date"  name="search"  value="">
                        <label class="active">Data da Leitura</label>
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
	                    <a class="breadcrumb">Leitura do Consumo</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row">
		<table>
				<thead>
					<tr>
                        <th>imagem</th>
						<th>Tipo Concessionária</th>
                        <th>Código do Medidor</th>
                        <th>Usuário do Medidor</th>
                        <th>Posição do Medidor</th>
                        <th>Data</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
                @forelse($registros as $registro)
                <tr>
                    <td>@if(isset($registro->imagem))
		                   <img width="60" src="{{ asset( $registro->imagem ) }}">
		                @endif
                    </td>
                    <td>{{ $registro->tipo_concessionaria }}</td>
                    <td>{{ $registro->cod_medidor }}</td>
                    <td>{{ $registro->descricao }}</td>
                    <td>{{ $registro->posicao }}</td>

                    <td>{{ isset($registro->data) ?  date( 'd/m/Y' , strtotime($registro->data)) : '' }}</td>
                    <td>
                        <a class="waves-effect waves-light btn blue"
                            href="{{ route('concessionarias.leituras.editarLeituras',$registro->id) }}">Leitura</a>
                        <a class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('concessionarias.leituras.destroyLeituras',$registro->id) }}' }">Deletar</a>
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
