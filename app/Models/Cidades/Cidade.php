<?php

namespace App\Models\Cidades;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {

    protected $fillable = ['cidade', 'estado_id'];
    public $timestamps = false;

    public function estados() {
        return $this->hasMany('App\Models\Cidades\Estado','estado_id');
    }
}
