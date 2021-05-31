@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
	<h2 class="center">Adicionar Tarifas</h2>
	<div class="row">
	 	<nav>
		    <div class="nav-wrapper green">
		      	<div class="col s12">
			        <a href="{{ route('home')}}" class="breadcrumb">Início</a>
			        <a href="{{route('concessionarias')}}" class="breadcrumb">Lista de Tarifas</a>
			        <a class="breadcrumb">Adicionar Tarifas</a>
		      	</div>
		    </div>
	  	</nav>
	</div>
	<div class="row">
		<form action="{{ route('concessionarias.tarifas.salvarTarifas')}}" method="post" enctype="multipart/form-data">

          {{csrf_field()}}

        @include('concessionarias.tarifas._form')

            <div class="input-field col m6 s12">
                <button class="btn blue">Adicionar</button>
            </div>


		</form>

	</div>

</div>


@endsection
