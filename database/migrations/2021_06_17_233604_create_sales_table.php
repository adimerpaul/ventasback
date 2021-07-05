<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
              $table->date("fecha");
              $table->double("total",10,2);
              $table->string("tipo");
              $table->string("codigocontrol");
              $table->string("codigoqr");
              $table->string("delivery")->default('');
              $table->boolean("cobrar")->default(false);
            
              $table->string("estado")->default('ACTIVO');
              $table->string("nrocomprobante");
            $table->double("monto",11,2);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('dosage_id');
            $table->foreign('dosage_id')->references('id')->on('dosages');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('sales');
    }
}
