@extends('layouts._gynPromo.app')
@section('content')
<div class="container">
	<h2 class="center">Fatura de Contas</h2>
	<div class="row ">
		<nav>
			<div class="nav-wrapper green">
				<div class="col s11">
					<a href="{{route('home')}}" class="breadcrumb">Início</a>
					<a href="{{route('concessionarias.faturamento')}}" class="breadcrumb">Faturamento de Contas</a>
					<a class="breadcrumb">Impressão de Fatura</a>
				</div>
			</div>
		</nav>
	</div>
	<div class="row ">

        <form action="{{route('concessionarias.faturamento.receberFatura', $registro->id)}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">

			@include('concessionarias.faturamento._form')

			<button class="btn blue">Receber</button>
		</form>
	</div>
</div>
@endsection
