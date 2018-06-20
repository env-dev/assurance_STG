<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPriceTtc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_models', function (Blueprint $table) {
            $table->decimal('price_ttc', 6, 2)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_models', function (Blueprint $table) {
            $table->decimal('price_ttc', 4, 2)->change();
        });
    }
}
