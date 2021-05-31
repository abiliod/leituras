<?php

namespace App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model{
    public function produtos(){
    	return $this->hasMany('App\Models\Produtos\Produto','grupo_id');
    }
}

