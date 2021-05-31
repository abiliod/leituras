<?php

namespace App\Models\Concessionarias;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{

    protected $table = 'leituras';

    protected $fillable=
    [
        'cod_medidor'
        , 'tipo_concessionaria'
        , 'posicao'
        , 'imagem'
        , 'data'
        , 'user'

    ];

    protected $casts = [
        'data' => 'date:Y-m-d',
    ];

}
