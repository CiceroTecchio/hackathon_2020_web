<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Acoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cod_tipo_acao')->unsigned();
            $table->foreign('cod_tipo_acao')->references('id')->on('tipos_acao');
            $table->bigInteger('cod_motorista')->unsigned();
            $table->foreign('cod_motorista')->references('id')->on('motoristas');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
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
        Schema::dropIfExists('acoes');
    }
}
