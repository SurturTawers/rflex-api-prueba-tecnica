<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('currencies', function (Blueprint $table){
            $table->string('codigo')->primary();
            $table->string('nombre');
            $table->string('unidad_medida');
            $table->boolean('is_active');
        });

        Schema::create('currencies_summary', function (Blueprint $table) {
            $table->string('codigo')->primary();
            $table->foreign('codigo')->references('codigo')->on('currencies');
            $table->dateTimeTz('fecha');
            $table->double('valor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies_summary');
        Schema::dropIfExists('currencies');
    }
};
