
<div class="input-field col m4 s12">
    <select name="tipo_concessionaria" >
        <option value="Energia" {{(isset($registro->tipo_concessionaria) && $registro->tipo_concessionaria == 'Energia'  ? 'selected' : '')}}>Energia</option>
        <option value="Agua" {{(isset($registro->tipo_concessionaria) && $registro->tipo_concessionaria == 'Agua'  ? 'selected' : '')}}>Agua</option>
    </select>
    <label>Tipo de Concessionaria</label>
</div>
<div class="input-field col m4 s12">
    <select name="tipo_consumidor" >
        <option value="Comercial" {{(isset($registro->tipo) && $registro->tipo == 'Comercial'  ? 'selected' : '')}}>Comercial</option>
        <option value="Residencial" {{(isset($registro->tipo) && $registro->tipo == 'Residencial'  ? 'selected' : '')}}>Residencial</option>
        <option value="Rural" {{(isset($registro->tipo) && $registro->tipo == 'Rural'  ? 'selected' : '')}}>Rural</option>
        <option value="Social" {{(isset($registro->tipo) && $registro->tipo == 'Social'  ? 'selected' : '')}}>Social</option>
    </select>
    <label>Tipo de Instalação</label>
</div>

<div class="input-field col m4 s12">
    <input type="text" name="custo_fixo" id="money2dig" class="validade" value="{{ isset($registro->custo_fixo) ? $registro->custo_fixo : '' }}">
	<label>Preço Fixo (TX.ILUM.PUBL)</label>
</div>

<div class="input-field col m6 s12">
    <input type="text" name="custo_unitario"  id="money6dig"    class="validade" value="{{ isset($registro->custo_unitario) ? $registro->custo_unitario : '' }}">
    <label>Preço Unitário</label>
</div>

<div class="input-field col m6 s12">
    <select name="tipo_custo_unitario" >
        <option value="kw" {{(isset($registro->tipo_custo_unitario) && $registro->tipo_custo_unitario == 'kw'  ? 'selected' : '')}}>Kw</option>
        <option value="mt3" {{(isset($registro->tipo_custo_unitario) && $registro->tipo_custo_unitario == 'mt3'  ? 'selected' : '')}}>Mt3</option>
    </select>
    <label>Tipo Preço Unitário</label>
</div>

<div class="input-field col m6 s12">
    <input type="text" name="custo_adicional" id="money2dig" class="validade" value="{{ isset($registro->custo_adicional) ? $registro->custo_adicional : '' }}">
    <label>Preço Adicional</label>
</div>
<div class="input-field col m6 s12">
    <select name="tipo_custo_adicional" >
        <option value="Bandeira_Suspenso" {{(isset($registro->tipo_custo_adicional) && $registro->tipo_custo_adicional == 'Período Suspenso kw'  ? 'selected' : '')}}>Bandeira Suspensa</option>
        <option value="Bandeira_Amarela" {{(isset($registro->tipo_custo_adicional) && $registro->tipo_custo_adicional == 'Bandeira Amarela kw'  ? 'selected' : '')}}>Bandeira Amarela kw</option>
        <option value="Bandeira_Vermelha kw" {{(isset($registro->tipo_custo_adicional) && $registro->tipo_custo_adicional == 'Bandeira Vermelha kw'  ? 'selected' : '')}}>Bandeira Vermelha kw</option>
    </select>
    <label>Tipo Preço Adicional</label>
</div>


<div class="input-field col m6 s12">
	<input type="date" name="vigencia" class="validade" value="{{ isset($registro->vigencia) ? $registro->vigencia : '' }}">
	<label class="active">Início da Vigência</label>
</div>

