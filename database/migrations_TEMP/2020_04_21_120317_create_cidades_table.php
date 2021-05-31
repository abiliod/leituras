<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codIbge')->nullable();
            $table->string('cidade');
            $table->bigInteger('estado_id')->unsigned()->default(0);

        });

        Schema::table('cidades', function (Blueprint $table) {
            //   $table->unsignedBigInteger('cliente_id');//altera a tabela como ja foi criado no evento anterior não precisa.
               $table->foreign('estado_id')->references('id')->on('estados');

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cidades');
    }
}
