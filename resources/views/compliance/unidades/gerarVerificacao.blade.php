@extends('layouts._gynPromo.app')
@section('content')
<div class="container">
	<h2 class="center">Gerar Inspeção</h2>
	<div class="row">
		<nav>
			<div class="nav-wrapper green">
				<div class="col s12">
					<a href="{{ route('home')}}" class="breadcrumb">Início</a>
                    <a href="{{route('compliance.unidades')}}" class="breadcrumb">Lista de Unidades</a>
					<a class="breadcrumb">Inspeção :   {{$registro->descricao}}  </a>
				</div>
			</div>
		</nav>
	</div>
    @if($errors->any())
        <div class="row red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </div>
    @endif
	<div class="row">
        <form action="{{route('compliance.unidades.salvarVerificacao')}}" method="post">
    		@CSRF

            <input type="hidden" name="unidade_id" value="{{$registro->id}}">

            <div class="input-field col s6">
                <select name="ciclo" id="ciclo">
                    <option value="2020" selected>2020</option>
                    <option value="2021">2021</option>
                </select>
                <label for="ciclo" >Ciclo de Verificação</label>
            </div>

            <div class="input-field col s6">
                <input type="date" name="datainiPreInspeção"  id="datainiPreInspeção" value="now();">
                <label  class="active" for="datainiPreInspeção" >Data Início</label>
            </div>

            <div class="input-field col s6">
                <input type="text" name="codigo"  id="codigo" value="">
                <label for="codigo" >Código Inspeção</label>
            </div>


            <div class="input-field col s6">
                <select name="tipoUnidade_id">
                    @foreach($tiposDeUnidade as $tipoDeUnidade)
                    <option value="{{ $tipoDeUnidade->id }}">{{ $tipoDeUnidade->sigla }} - {{ $tipoDeUnidade->tipodescricao }}</option>
                    @endforeach
                </select>
                <label for="tipoUnidade_id" >Tipo de Unidade</label>
            </div>
            <div class="input-field col s6">
                <select name="tipoVerificacao" id="tipoVerificacao">
                    @foreach($tiposDeUnidade as $tipoDeUnidade)
                        @if($tipoDeUnidade->tipoInspecao == "Ambos")
                            <option value="Presencial">Presencial</option>
                            <option value="Remoto">Remoto</option>
                        @else
                            <option value="{{ $tipoDeUnidade->tipoInspecao }}">{{ $tipoDeUnidade->tipoInspecao }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="tipoVerificacao" >Tipo de Verificação</label>
            </div>
            <div class="input-field col s6">
                <select name="status" id="status">
                    <option value="Em Inspeção" selected>Em Inspeção</option>
                </select>
                <label for="status" >Status</label>
            </div>
            <div class="input-field col s6">
                <select name="inspetorcoordenador" id="inspetorcoordenador">
                    <option value="">Inspetor Coordenador</option>
                    <option value="8.328.808-2">Abilio Dias Ferreira</option>
                    <option value="8.329.980-7">Wellington Silva</option>
                    <option value="8.329.980-x">Elias Silva</option>
                    <option value="8.329.980-y">Marcelo Wollf</option>
                    <option value="8.329.980-z">Ana Coracy</option>
                    <option value="8.329.980-j">Jorge Antônio</option>
                </select>
                <label for="inspetorcoordenador" >Inspetor Coordenador</label>
            </div>

            <div class="input-field col s6">
                <select name="inspetorcolaborador" id="inspetorcolaborador">
                    <option value="">Inspetor Colaborador</option>
                    <option value="8.328.808-2">Abilio Dias Ferreira</option>
                    <option value="8.329.980-7">Wellington Silva</option>
                    <option value="8.329.980-x">Elias Silva</option>
                    <option value="8.329.980-y">Marcelo Wollf</option>
                    <option value="8.329.980-z">Ana Coracy</option>
                    <option value="8.329.980-j">Jorge Antônio</option>
                </select>
                <label for="inspetorcolaborador" >Inspetor Colaborador</label>
            </div>

                <div class="input-field col s4">
                <input type="text" name="numHrsPreInsp"  id="numHrsPreInsp" value="8">
                <label for="numHrsPreInsp" >Horas Pré Inspeção</label>
            </div>
            <div class="input-field col s4">
                <input type="text" name="numHrsDesloc"  id="numHrsDesloc" value="0">
                <label for="numHrsDesloc" >Horas Deslocamento</label>
            </div>
            <div class="input-field col s4">
                <input type="text" name="numHrsInsp"  id="numHrsInsp" value="8">
                <label for="numHrsInsp" >Horas Inspeção</label>
            </div>

            <div class="row">
                 <button class="btn blue">Gerar Inspeção</button>
            </div>
        </form>
    </div>
</div>
@endsection
