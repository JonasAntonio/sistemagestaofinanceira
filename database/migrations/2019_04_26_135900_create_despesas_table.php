<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned(); 
            $table->string('nome');
            $table->decimal('valor');
            $table->date('data_vencimento');
            $table->string('descricao');
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->string('forma_pagamento');
            //Quando Escolher Cartão de crédito pega o ID do Cartão e poe aqui
            //$table->bigInteger('cartao_id')->unsigned()->nullable();
            $table->boolean('pago');
            $table->boolean('parcelado');
            $table->integer('dia_cobranca_parcela');
            $table->integer('num_parcelas');
            $table->boolean('notificar');
            $table->integer('num_meses');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            //Quando Escolher Cartão de crédito pega o ID do Cartão e poe aqui
            //$table->foreign('cartao_id')->references('id')->on('cartao_creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
