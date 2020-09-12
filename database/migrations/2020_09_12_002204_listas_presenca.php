<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListasPresenca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_presenca', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cod_presenca')->unsigned();
            $table->foreign('cod_presenca')->references('id')->on('presencas');
            $table->bigInteger('cod_aluno')->unsigned();
            $table->foreign('cod_aluno')->references('id')->on('alunos');
            $table->boolean('fg_presente');
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
        Schema::dropIfExists('lista_presenca');
    }
}
