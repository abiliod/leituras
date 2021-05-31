<?php

namespace App\Models\Cidades;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {
    protected $fillable= [
        'cep'

    ];

    public function pessoa() {
        return $this->belongsToMany(Pessoa::class);
    }
}
