@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Lista de Unidades</h2>
	<div class="row">
		<nav>
			<div class="nav-wrapper orange">
                <form action="{{route('compliance.unidades.search')}}" method="post">
					@csrf
					<div class="input-field">
						<input id="search" type="search"  name="search" min(4) required autofocus>
						<label class="label-icon" for="search">Pesquisas - Digite: Parte do Nome da Unidade, do Telefone, MCU ou Telefone<i class="material-icons">search</i></label>
						<i class="material-icons">close</i>
					</div>
				</form>
			</div>
			<div class="row">
			</div>
			<div class="nav-wrapper green">
				<div class="col s12">
					<a href="{{ route('home')}}" class="breadcrumb">Início</a>
					<a class="breadcrumb">Lista de Unidades</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row">
		<table>
				<thead>
					<tr>
						<th>Unidade</th>
						<th>Telefone</th>
                        <th>E-Mail</th>
                        <th>Hora Abertura</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
				@foreach($registros as $registro)
					<tr>
						<td>{{ $registro->descricao }}</td>
						<td>{{ $registro->telefone }}</td>
                        <td>{{ $registro->email }}</td>
                        <td>{{ $registro->inicio_expediente }}</td>
						<td>
                        <a class="waves-effect waves-light btn orange" href="{{ route('compliance.unidades.editar',$registro->id) }}">Editar</a>
                        <a class="waves-effect waves-light btn blue" href="{{ route('compliance.unidades.gerarVerificacao',$registro->id) }}">Gerar Inspeção</a>
                        <a class="waves-effect waves-light btn red disabled " href="" >Deletar</a>




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
			<a class="btn blue" href="!#">Adicionar</a>
		</div>
   	</div>

@endsection
