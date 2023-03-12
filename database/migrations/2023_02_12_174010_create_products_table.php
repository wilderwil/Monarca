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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->decimal('cost',10,2);
            $table->decimal('price',10,2);
            $table->integer('stock');
            $table->integer('alert');
            $table->string('image',255)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('size');
            $table->string('color',50);
            $table->string('placa',50);
            $table->string('features',255);
            $table->foreign('category_id')->references('id')->on('categories');
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
};