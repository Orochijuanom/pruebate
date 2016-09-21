<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grado_id')->unsigned();
            $table->integer('materia_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('grado_id')
                  ->references('id')->on('grados')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->foreign('materia_id')
                  ->references('id')->on('materias')
                  ->onUpdate('no action')
                  ->onDelete('restrict');
            
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('no action')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
}
