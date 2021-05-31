
    <div class="row col s12">
        <div class="input-field col s6">
            <input name="cep" type="text" id="cep" value="{{ isset($cep) ? $cep : '' }}" size="10" maxlength="9"
                    onblur="pesquisacep(this.value);" />
            <label>CEP</label>
        </div>
    </div>

    <div class="row col s12">
        <div class="input-field col s5">
        <input type="text"  id="rua" name="logradouro" class="validade" value="" placerolder="Logradouro" >
            <label class="active">Logradouro</label>
        </div>
        <div class="input-field col s2">
        <input name="numero" type="text" size="40" />
            <label class="active">Número</label>
        </div>
        <div class="input-field col s2">
        <input name="complemento" type="text" size="40" />
            <label class="active">Complemento</label>
        </div>
        <div class="input-field col s3">
        <input name="bairro" type="text" id="bairro" size="40" />
            <label class="active">Bairro</label>
        </div>
    </div>

    <div class="row col s12">
        <div class="input-field col s6">
            <input name="cidade" type="text" id="cidade" size="40" />
            <label class="active">Cidade</label>
        </div>

        <div class="input-field col s2">
            <input name="uf" id="uf" type="text"  size="40" />
            <label class="active">Estado</label>
        </div>
        <div class="input-field col m4 s12">
            <select name="tipo" >
                <option value="">Escolha uma opção</option>
                <option value="Comercial">Comercial</option>
                <option value="Residencial">Residencial</option>
                <option value="Entrega">Entrega</option>

            </select>
            <label>Tipo de Endereço</label>
        </div>
    </div>
        <input name="ibge" type="hidden" id="ibge" value="" size="40" />

