
<div class="input-field col m4 s12">
    <select name="tipo_concessionaria" >
    <option value="" disabled selected>Escolha uma opção</option>
    <option value="Energia" {{(isset($registro->tipo_concessionaria) && $registro->tipo_concessionaria == 'Energia'  ? 'selected' : '')}}>Energia</option>
    <option value="Agua" {{(isset($registro->tipo_concessionaria) && $registro->tipo_concessionaria == 'Agua'  ? 'selected' : '')}}>Agua</option>

    </select>
    <label>Tipo de Concessionaria</label>
</div>


<div class="input-field col m4 s12">
	<input type="text" name="cod_medidor" class="validade" value="{{ isset($registro->cod_medidor) ? $registro->cod_medidor : '' }}">
	<label>Identificação Medidor</label>
</div>
<div class="input-field col m4 s12">
	<input type="text" name="pessoa_cpfcnpj" class="validade" value="{{ isset($registro->pessoa_cpfcnpj) ? $registro->pessoa_cpfcnpj : '' }}">
	<label>CpfCnpj/Cliente</label>
</div>

<div class="input-field col m4 s12">
    <select name="status" >
    <option value="" disabled selected>Escolha uma opção</option>
    <option value="Ativo" {{(isset($registro->status) && $registro->status == 'Ativo'  ? 'selected' : '')}}>Ativo</option>
    <option value="Inativo" {{(isset($registro->status) && $registro->status == 'Inativo'  ? 'selected' : '')}}>Inativo</option>

    </select>
    <label>Status</label>
</div>


<div class="input-field col m4 s12">
	<input type="text" name="descricao" class="validade" value="{{ isset($registro->descricao) ? $registro->descricao : '' }}">
	<label>Descricao</label>
</div>

<div class="input-field col m4 s12">
    <select name="tipo" >
    <option value="" disabled selected>Escolha uma opção</option>
    <option value="Comercial" {{(isset($registro->tipo) && $registro->tipo == 'Comercial'  ? 'selected' : '')}}>Comercial</option>
    <option value="Residencial" {{(isset($registro->tipo) && $registro->tipo == 'Residencial'  ? 'selected' : '')}}>Residencial</option>
    <option value="Rural" {{(isset($registro->tipo) && $registro->tipo == 'Rural'  ? 'selected' : '')}}>Rural</option>
    <option value="Social" {{(isset($registro->tipo) && $registro->tipo == 'Social'  ? 'selected' : '')}}>Social</option>
    </select>
    <label>Tipo de Instalação</label>
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

    <div class="input-field  col m6 s12">
        <input name="cep" type="text" id="cep"
                value="{{ isset($registro->cep) ? $registro->cep : '' }}"
                size="10" maxlength="9"
                onblur="pesquisacep(this.value);" />
        <label class="active">CEP</label>
    </div>



<div class="input-field col m6 s12">
<input name="rua" type="text" size="40"
value="{{isset($registro->logradouro) ? $registro->logradouro : ''}}"/>
    <label class="active">Logradouro</label>
</div>


<div class="input-field col m4 s12">
<input name="numero" type="text" size="40"
value="{{isset($registro->numero) ? $registro->numero : ''}}"/>
    <label class="active">Número</label>
</div>

<div class="input-field col m4 s12">
<input name="complemento" type="text" size="40"
value="{{isset($registro->complemento) ? $registro->complemento : ''}}"
onkeyup="this.value = this.value.toUpperCase();"/>
    <label class="active">Complemento</label>
</div>
<div class="input-field  col m4 s12">
<input name="bairro" type="text" id="bairro" size="40"
value="{{isset($registro->bairro) ? $registro->bairro : ''}}" readonly/>
    <label class="active">Bairro</label>
</div>

<div class="input-field  col m6 s12">
    <input name="cidade" type="text" id="cidade" size="40"
    value="{{isset($registro->cidade) ? $registro->cidade : ''}}" readonly/>
    <label class="active">Cidade</label>
</div>

<div class="input-field  col m6 s12">
    <input name="uf" id="uf" type="text"  size="40"
    value="{{ isset($registro->estado) ? $registro->estado : '' }}" readonly />
    <label class="active">Estado</label>
</div>



