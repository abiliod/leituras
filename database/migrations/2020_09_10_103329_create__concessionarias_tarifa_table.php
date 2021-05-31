<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcessionariasTarifaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_concessionaria');
            $table->string('tipo_consumidor');
            $table->decimal('custo_fixo', 8, 4)->default(0);
            $table->decimal('custo_unitario', 8, 4)->default(0);
            $table->string('tipo_custo_unitario');
            $table->date('vigencia');
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
        Schema::dropIfExists('tarifas');
    }
}
