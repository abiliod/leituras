@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Adicionar Contas</h2>
	<div class="row">
	 	<nav>
		    <div class="nav-wrapper green">
		      	<div class="col s12">
			        <a href="{{ route('home')}}" class="breadcrumb">Início</a>
			        <a href="{{route('concessionarias')}}" class="breadcrumb">Lista de Contas</a>
			        <a class="breadcrumb">Adicionar Contas</a>
		      	</div>
		    </div>
	  	</nav>
	</div>
	<div class="row">
		<form action="{{ route('concessionarias.contas.salvarContas')}}" method="post" enctype="multipart/form-data">
        
          {{csrf_field()}}

        @include('concessionarias.contas._form')

		<button class="btn blue">Adicionar</button>


		</form>

	</div>

</div>


@endsection
