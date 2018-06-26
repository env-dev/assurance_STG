<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherColumnsSmartphone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smartphones', function (Blueprint $table) {
            $table->string('imei2')->after('imei');
            $table->string('sn')->after('imei2')->nullable();
            $table->string('wifi')->after('sn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smartphones', function (Blueprint $table) {
            $table->dropColumn('imei2');
            $table->dropColumn('sn');
            $table->dropColumn('wifi');
        });
    }
}
