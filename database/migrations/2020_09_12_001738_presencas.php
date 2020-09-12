<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Presencas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presencas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dia');
            $table->bigInteger('cod_turma')->unsigned();
            $table->foreign('cod_turma')->references('id')->on('turmas');
            $table->bigInteger('cod_professor')->unsigned();
            $table->foreign('cod_professor')->references('id')->on('users');
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
        Schema::dropIfExists('presencas');
    }
}
