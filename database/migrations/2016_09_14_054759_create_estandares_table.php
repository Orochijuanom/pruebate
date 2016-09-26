<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstandaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estandares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('asignacione_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('estandares');
    }
}
