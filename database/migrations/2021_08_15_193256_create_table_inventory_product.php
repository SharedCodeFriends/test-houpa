<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInventoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_product', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->unsignedBigInteger('fk_product');
            $table->unsignedBigInteger('fk_size');
            $table->unsignedBigInteger('fk_color');
            $table->timestamps();

            $table->foreign('fk_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fk_size')->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fk_color')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_product');
    }
}
