<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mandat_num');
            $table->string('guarantee');
            $table->date('data_flow');
            $table->decimal('total_ttc', 6, 2);
            $table->boolean('new')->default(1);
            $table->integer('smartphone_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->timestamps();

            $table->foreign('smartphone_id')
                    ->references('id')->on('smartphones');
            $table->foreign('client_id')
                    ->references('id')->on('clients');
            
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
