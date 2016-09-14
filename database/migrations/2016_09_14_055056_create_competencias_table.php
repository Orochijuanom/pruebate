<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('estandare_id')->unsigned();
            $table->integer('asignacione_id')->unsigned();
            $table->timestamps();

            $table->foreign('estandare_id')
                  ->references('id')->on('estandares')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->foreign('asignacione_id')
                  ->references('id')->on('asignaciones')
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
        Schema::dropIfExists('competencias');
    }
}
