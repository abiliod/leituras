<?php

namespace App\Models\Correios;

use Illuminate\Database\Eloquent\Model;

class ItemDeInspecao extends Model
{
    protected $table = 'itensDeInspecao';

    protected $fillable=
    [
        'verificacao_id', //veriricação relacionada
        'unidade_id', //unidade verificada
        'tipoUnidade_id', //Tipo de unidade
        'grupoVerificacao_id', //grupo de verificação
        'testeVerificacao_id',  // $registro->id teste de verificação
        'avaliacao',  //conforme/Não Conforme/Não Executa Tarefa
        'oportunidadeAprimoramento',
        'imagem',
        'reincidencia',
        'codVerificacaoAnterior',
        'numeroGrupoReincidente',
        'numeroItemReincidente',
        'itemQuantificado',
        'valorFalta',
        'valorSobra',
        'valorRisco',
        'orientacao',
        'situacao',
        'consequencias',
        'eventosSistema',
        'evidencia',
        'norma',
        'diretorio',

    ];

    public function verificacao()
    {
        return $this->belongsTo('App\Models\Correios\Verificacao','id');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Models\Correios\Unidade','id');
    }

    public function tipoDeUnidade()
    {
        return $this->belongsTo('App\Models\Correios\TipoDeUnidade','id');
    }

    public function grupoDeVerificacao()
    {
        return $this->belongsTo('App\Models\Correios\GrupoDeVerificacao','id');
    }

    public function testeDeVerificacao()
    {
        return $this->belongsTo('App\Models\Correios\TesteDeVerificacao','id');
    }


}
