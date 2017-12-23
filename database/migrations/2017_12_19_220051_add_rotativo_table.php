<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRotativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotativo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sucursal_id')->unsigned();
            $table->integer('tratamiento_id')->unsigned();
            $table->string('profesional');
            $table->boolean('lunes')->default(false);
            $table->boolean('martes')->default(false);
            $table->boolean('miercoles')->default(false);
            $table->boolean('jueves')->default(false);
            $table->boolean('viernes')->default(false);
            $table->boolean('sabado')->default(false);
            $table->boolean('domingo')->default(false);

            $table->foreign('sucursal_id')->references('id')->on('sucursal')->onDelete('cascade');
            $table->foreign('tratamiento_id')->references('id')->on('tratamiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
