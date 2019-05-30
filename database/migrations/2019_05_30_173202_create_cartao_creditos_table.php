<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartaoCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartao_creditos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('nome');
            $table->decimal('limite');
            $table->tinyInteger('bandeira');
            // Quando Possuir Conta $table->bigInteger('conta_id')->unsigned();
            $table->tinyInteger('diaPagamento');
            $table->tinyInteger('diaFechamento');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Quando Possuir Conta $table->foreign('conta_id')->references('id')->on('contas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartao_creditos');
    }
}
