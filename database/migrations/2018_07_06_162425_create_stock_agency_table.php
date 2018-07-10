<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_agencies', function (Blueprint $table) {
            $table->integer('agency_id')->unsigned();
            $table->integer('smartphone_id')->unsigned();
            $table->timestamps();


            $table->primary(['agency_id', 'smartphone_id']);
            $table->foreign('smartphone_id')->references('id')->on('smartphones');
            $table->foreign('agency_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_agencies');
    }
}
