@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Unidades Consumidoras</h2>
	    <div class="row">
			<div class="nav-wrapper green">
               <form action="{{route('concessionaria.search')}}" method="post">
					@csrf
                    <div class="input-field col m3 s12">
                        <select name="tipo_concessionaria" >

                        <option value="Energia">Energia</option>
                        <option value="Agua">Água</option>
                        </select>
                        <label>Tipo de Concessionaria</label>
                    </div>
                    <div class="input-field col m3 s12">
                        <select name="status" >
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        </select>
                        <label>Status</label>
                    </div>
                    <div class="input-field col m4 s12">
	                    <input id="search" type="search"  name="search"  value="">
                        <label class="label-icon" for="search">
                        </label><i class="material-icons">search</i>
                        <label>CPF/CNPJ Cliente</label>
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
                        <th>Medidor</th>
						<th>Tipo de Concessionaria</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Cliente</th>
						<th>Ação        <a   class="waves-effect waves-light btn blue rigth"
                            href="{{ route('concessionarias.contas.gerarLeitura') }}">Gerar Todas Leituras</a></th>
					</tr>
				</thead>
				<tbody>
                @forelse($registros as $registro)
                <tr>
                    <td>{{ $registro->cod_medidor }}</td>
                    <td>{{ $registro->tipo_concessionaria }}</td>
                    <td>{{ $registro->descricao }}</td>

                    <td>{{ $registro->status }}</td>
                    <td>{{ $registro->pessoa_cpfcnpj }} <!--  $registro->pessoa_id->nome  --> </td>
                    <td>
                    <a  class="waves-effect waves-light btn blue"
                            href="{{ route('concessionarias.contas.gerarLeituraId',$registro->id) }}">Gerar Leitura</a>
                        <a class="waves-effect waves-light btn orange"
                            href="{{ route('concessionarias.contas.editarContas',$registro->id) }}">Editar</a>
                        <a class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('concessionarias.contas.destroyContas',$registro->id) }}' }">Deletar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td> Não há Registros </td>
                    <td> <a class="btn blue" href="{{route('concessionarias.contas.adicionarContas')}}">Adicionar</a> </td>

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
