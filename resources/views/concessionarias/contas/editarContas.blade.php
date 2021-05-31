@extends('layouts._gynPromo.app')
@section('content')
<div class="container">
	<h2 class="center">Editar Contas</h2>
	<div class="row ">
		<nav>
			<div class="nav-wrapper green">
				<div class="col s11">
					<a href="{{route('home')}}" class="breadcrumb">Início</a>
					<a href="{{route('concessionarias')}}" class="breadcrumb">Lista de Contas</a>
					<a class="breadcrumb">Editar Contas</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row ">
		<form action="{{ route('concessionarias.contas.atualizarContas',$registro->id) }}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">

			@include('concessionarias.contas._form')

			<button class="btn blue">Atualizar</button>
		</form>
	</div>
</div>
@endsection
