<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesConsumidoraTable extends Migration
{    /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('unidadesconsumidoras', function (Blueprint $table) {
           $table->id();
           $table->string('cod_medidor')->nullable();//pode ser nulo
           $table->enum('tipo_concessionaria',['Energia','Agua']);
           $table->string('descricao')->nullable();//pode ser nulo
           $table->string('imagem')->nullable();//pode ser nulo
           $table->enum('status',['Ativo','Inativo'])->default('Inativo');
           $table->integer('rateio_custo_fixo')->default(1);
           $table->string('cep');
           $table->string('estado')->nullable();//pode ser nulo
           $table->string('cidade')->nullable();//pode ser nulo;
           $table->string('bairro')->nullable();//pode ser nulo;
           $table->string('logradouro')->nullable();//pode ser nulo;
           $table->string('numero')->nullable();//pode ser nulo;
           $table->string('complemento')->nullable();//pode ser nulo;
           $table->enum('tipo',['Comercial','Residencial','Social'])->default('Comercial');
           $table->string('pessoa_cpfcnpj');
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
       Schema::dropIfExists('unidadesconsumidoras');
   }
}
