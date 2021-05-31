
<div class="input-field col m3 s12">
    <input type="text" name="tipo_concessionaria" class="validade" value="{{ isset($registro->tipo_concessionaria) ? $registro->tipo_concessionaria : '' }}" readonly>
	<label>Tipo de Concessionária</label>
</div>


<div class="input-field col m3 s12">
	<input type="text" name="cod_medidor" class="validade" value="{{ isset($registro->cod_medidor) ? $registro->cod_medidor : '' }}" readonly>
	<label>Identificação Medidor</label>
</div>

<div class="input-field col m4 s12">
	<input type="text" name="posicao" id="money4dig" class="validade" value="{{ isset($registro->posicao) ? $registro->posicao : '' }}">
	<label>Posição do Medidor</label>
</div>

<div class="input-field col m2 s12">
	<input type="date" name="data" class="validade" value="{{ isset($registro->data) ? $registro->data : '' }}">
	<label class="active">Data da Leitura</label>
</div>

<div class="row">
	<div class="file-field input-field col m6 s12">
		<div class="btn">
			<span>Imagem Medidor</span>
			<input type="file" name="imagem">
		</div>
		<div class="file-path-wrapper">
			<input type="text" class="file-path validade">
		</div>
	</div>
	<div class="col m6 s12">
		@if(isset($registro->imagem))
		<img width="120" src="{{ asset( $registro->imagem ) }}">
		@endif
	</div>
</div>


