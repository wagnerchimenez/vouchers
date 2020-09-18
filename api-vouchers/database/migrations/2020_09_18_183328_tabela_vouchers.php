<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelaVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->date('expira_em');
            $table->date('utilizado_em');

            $table->bigInteger('clientes_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes');

            $table->bigInteger('ofertas_id')->unsigned();
            $table->foreign('ofertas_id')->references('id')->on('ofertas');

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
        Schema::dropIfExists('vouchers');
    }
}
