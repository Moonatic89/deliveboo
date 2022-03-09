<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table
                ->unsignedBigInteger('restaurant_id')
                ->nullable()
                ->after('id');
            $table
                ->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_restaurant_id_foreign');
            $table->dropColumn('restaurant_id');
        });
    }
}