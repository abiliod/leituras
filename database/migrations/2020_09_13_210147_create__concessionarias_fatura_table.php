<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcessionariasFaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();
            $table->string('cod_medidor');
            $table->string('status_fatura');
            $table->date('dataLeituraAtual');
            $table->decimal('posicaoLeituraAtual', 8, 4);
            $table->decimal('custo_fixo', 8, 4);
            $table->decimal('custo_unitario', 8, 4);
            $table->date('vigencia_tarifa');
            $table->date('dataLeituraAnterior');
            $table->decimal('posicaoLeituraAnterior', 8, 4);
            $table->integer('dias');
            $table->decimal('consumo', 8, 4);
            $table->decimal('valor_consumo', 8, 4);
            $table->decimal('rateio_fixo', 8, 4);
            $table->decimal('total_abatimento', 8, 4);
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('imagem')->nullable();
            $table->decimal('custo_adicional', 8, 4)->default(0);
            $table->string('tipo_custo_adicional')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturas');
    }
}
