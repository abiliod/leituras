<?php

namespace App\Models\Concessionarias;

use Illuminate\Database\Eloquent\Model;

class UnidadeConsumidora extends Model
{

    protected $table = 'unidadesconsumidoras';

    protected $fillable=
    [
        'cod_medidor',
        'tipo_concessionaria',
        'descricao',
        'imagem',
        'status',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'tipo',
        'pessoa_cpfcnpj',
    ];

}
