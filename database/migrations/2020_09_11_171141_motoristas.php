<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Motoristas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cod_aluno')->unsigned();
            $table->foreign('cod_aluno')->references('id')->on('alunos');
            $table->bigInteger('cod_motorista')->unsigned();
            $table->foreign('cod_motorista')->references('id')->on('motoristas');
            $table->string('fg_ativo');
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
        Schema::dropIfExists('motoristas');
    }
}
