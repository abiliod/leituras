<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcessionariasLeituraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leituras', function (Blueprint $table) {
            $table->id();
            $table->string('cod_medidor');
            $table->string('tipo_concessionaria');
            $table->decimal('posicao', 8, 4)->default(0);
            $table->string('imagem')->nullable();
            $table->date('data')->nullable();
            $table->string('user')->nullable();
            $table->enum('status',['Pendente','Concluso','Em Análise','Faturado'])->default('Pendente');
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
        Schema::dropIfExists('leituras');
    }
}
