<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creata tabella prodotti (piatti)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('ingredients')->nullable();
            $table->float('price', 6, 2);
            $table->boolean('visible')->default(true);
            $table->string('product_image')->nullable();
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
        Schema::dropIfExists('products');
    }
}