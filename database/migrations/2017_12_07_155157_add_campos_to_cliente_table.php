<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposToClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->string('localidad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ocupacion')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->dropColumn(['email', 'localidad', 'fecha_nacimiento', 'ocupacion']);
        });
    }
}
