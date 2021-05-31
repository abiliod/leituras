<?php

namespace App\Models\Concessionarias;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{

    protected $table = 'faturas';

    protected $fillable=
    [
        'cod_medidor',
        'status_fatura',
        'dataLeituraAtual',
        'posicaoLeituraAtual',
        'custo_fixo',
        'custo_unitario',
        'vigencia_tarifa',
        'dataLeituraAnterior',
        'posicaoLeituraAnterior',
        'dias',
        'consumo',
        'valor_consumo',
        'rateio_fixo',
        'total_abatimento',
        'data_vencimento',
        'data_pagamento',
        'tipo_custo_adicional',
        'custo_adicional',
        'imagem'

    ];

    protected $casts = [
        'dataLeituraAnterior' => 'date:Y-m-d',
        'dataLeituraAtual' => 'date:Y-m-d',
        'vigencia_tarifa' => 'date:Y-m-d',
        'data_vencimento' => 'date:Y-m-d',
        'data_pagamento' => 'date:Y-m-d',
    ];
}
