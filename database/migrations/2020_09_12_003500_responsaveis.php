<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsaveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cod_aluno')->unsigned();
            $table->foreign('cod_aluno')->references('id')->on('alunos');
            $table->bigInteger('cod_responsavel')->unsigned();
            $table->foreign('cod_responsavel')->references('id')->on('users');
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
        Schema::dropIfExists('responsaveis');
    }
}
