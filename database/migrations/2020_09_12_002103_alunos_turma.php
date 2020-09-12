<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlunosTurma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_turma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cod_turma')->unsigned();
            $table->foreign('cod_turma')->references('id')->on('turmas');
            $table->bigInteger('cod_aluno')->unsigned();
            $table->foreign('cod_aluno')->references('id')->on('alunos');
            $table->boolean('fg_ativo');
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
        Schema::dropIfExists('alunos_turma');
    }
}
