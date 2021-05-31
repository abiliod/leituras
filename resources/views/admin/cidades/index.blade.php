@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Lista de Cidades</h2>
	<div class="row">
		<nav>
			<div class="nav-wrapper">
				<form action="{{route('admin.cidades.search')}}" method="post">
					@csrf
					<div class="input-field">
						<input id="search" type="search"  name="search" min(4) required autofocus>
						<label class="label-icon" for="search"><i class="material-icons">search</i></label>
						<i class="material-icons">close</i>
					</div>
				</form>
			</div>
			<div class="row">
			</div>
			<div class="nav-wrapper green">
				<div class="col s12">
					<a href="{{ route('home')}}" class="breadcrumb">Início</a>
					<a class="breadcrumb">Lista de Cidades</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Estado</th>
						<th>Sigla do Estado</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
				@foreach($registros as $registro)
					<tr>
						<td>{{ $registro->id }}</td>
						<td>{{ $registro->cidade}}</td>
						<td>{{ $registro->estado}}</td>
						<td>{{ $registro->sigla }}</td>
						<td>
							<a class="btn orange" href="{{ route('admin.cidades.editar',$registro->id) }}">Editar</a>
							<a class="btn red" href="javascript: if(confirm('Deletar esse registro?')){ window.location.href = '{{ route('admin.cidades.deletar',$registro->id) }}' }">Deletar</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="row">
			     {!! $registros->links() !!}
            </div>
		</div>
		<div class="row">
			<a class="btn blue" href="{{route('admin.cidades.adicionar')}}">Adicionar</a>
		</div>
	</div>
@endsection
