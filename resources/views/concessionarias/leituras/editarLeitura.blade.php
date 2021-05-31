@extends('layouts._gynPromo.app')
@section('content')
<div class="container">
	<h2 class="center">Leitura de Contas</h2>
	<div class="row ">
		<nav>
			<div class="nav-wrapper green">
				<div class="col s11">
					<a href="{{route('home')}}" class="breadcrumb">Início</a>
					<a href="{{route('concessionarias.leituras')}}" class="breadcrumb">Leitura de Contas</a>
					<a class="breadcrumb">Posição do Consumo</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row ">
		<form action="{{ route('concessionarias.leituras.atualizarLeituras',$registro->id) }}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">

			@include('concessionarias.leituras._form')

			<button class="btn blue">Atualizar</button>
		</form>
	</div>
</div>
@endsection
