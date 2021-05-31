<div class="input-field">
	<input type="text" name="cidade" class="validade" value="{{ isset($registro->cidade) ? $registro->cidade : '' }}">
	<label>Nome da Cidade</label>
</div>

<div class="input-field">
    <select name="estado_id">
	     @foreach($estados as $estado)
         @isset($registro)
         <option value="{{ $estado->id }}" {{(isset($registro->estado_id)
          && $registro->estado_id == $estado->id  ? 'selected' : '')}}>
          {{ $estado->estado }}</option>
         @else
         <option value="0" >Selecione o Estado</option>
         <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
         @endisset
        @endforeach
    </select>
    <label>Estados</label>
</div>
