<?php

namespace App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model{
    protected $table = "produtos";

    public function categoria(){
    	return $this->belongsTo('App\Models\Produtos\Categoria','categoria_id');
    }
    
    public function grupo(){
    	return $this->belongsTo('App\Models\Produtos\Grupo','grupo_id');
    }

    public function fabricante(){
    	return $this->belongsTo('App\Models\Pessoa\Pessoa','fabricante_id');
    }
}
