<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('price',10,2);
            $table->integer('quantity');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->timestamps();
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
        Schema::dropIfExists('sale_details');
    }
};