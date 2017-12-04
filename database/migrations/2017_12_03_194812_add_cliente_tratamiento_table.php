<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClienteTratamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_tratamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('tratamiento_id')->unsigned();
            $table->integer('cantidad')->nullable($value = true);
            $table->float('precio')->nullable($value = true);
            $table->float('abonado')->nullable($value = true);
            $table->float('saldo')->nullable($value = true);
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('tratamiento_id')->references('id')->on('tratamiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_tratatamiento');
    }
}
