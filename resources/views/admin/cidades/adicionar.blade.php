@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Adicionar Cidade</h2>
	<div class="row">
	 	<nav>
		    <div class="nav-wrapper green">
		      	<div class="col s12">
			        <a href="{{ route('home')}}" class="breadcrumb">Início</a>
			        <a href="{{route('admin.cidades')}}" class="breadcrumb">Lista de Cidades</a>
			        <a class="breadcrumb">Adicionar Cidades</a>
		      	</div>
		    </div>
	  	</nav>
	</div>
	<div class="row">
		<form action="{{ route('admin.cidades.salvar') }}" method="post">
		@csrf

		@include('admin.cidades._form')
		<button class="btn blue">Adicionar</button>
		</form>
	</div>
</div>
@endsection
