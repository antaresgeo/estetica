<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fecha', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rotativo_id')->unsigned();
            $table->date('fecha');
            $table->timestamps();
            $table->foreign('rotativo_id')->references('id')->on('rota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fecha');
    }
}
