<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosages', function (Blueprint $table) {
            $table->id();
            $table->string('nrotramite');
            $table->string('nroautorizacion');
            $table->string('nrofactini');
            $table->string('llave');
            $table->date('desde');
            $table->date('hasta');
            $table->string('leyenda');
            $table->boolean('activo')->default(false);
            $table->string('nrofactura');
            $table->unsignedBigInteger('empresa_id')->default(1);
            $table->foreign('empresa_id')->references('id')->on('empresas');
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
        Schema::dropIfExists('dosages');
    }
}
