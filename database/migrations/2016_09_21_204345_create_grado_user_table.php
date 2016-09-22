<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grado_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('anio');
           

            $table->foreign('grado_id')
                  ->references('id')->on('grados')
                  ->onDelete('restrict')
                  ->onUpdate('no action');
            
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->unique(['grado_id', 'user_id', 'anio'], 'asignacion_unica_anual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_user');
    }
}
