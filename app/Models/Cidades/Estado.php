<?php

namespace App\Models\Cidades;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model{

    protected $fillable = ['nome'];

    public $timestamps = false;

    public function cidades() {
        return $this->hasMany('App\Models\Cidades\Cidades',' estado_id');
    }

}
