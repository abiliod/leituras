<?php

namespace App\Models\Concessionarias;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas';

    protected $fillable=
    [
         'tipo_concessionaria'
        , 'tipo_consumidor'
        , 'tipo_custo_unitario'
        , 'custo_fixo'
        , 'custo_unitario'
        , 'tipo_custo_adicional'
        , 'custo_adicional'
        , 'vigencia'


];

    protected $casts = [
        'vigencia' => 'date:Y-m-d',
    ];
}
