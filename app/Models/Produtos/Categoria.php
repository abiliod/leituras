<?php

namespace App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    public function produtos(){
    	return $this->hasMany('App\Models\Produtos\Produto','categoria_id');
    }

}
