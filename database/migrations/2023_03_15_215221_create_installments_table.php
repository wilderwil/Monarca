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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->date('expiration_date');
            $table->decimal('amount', 10, 2);
            $table->enum('estado', ['pagado', 'pendiente'])->default('pendiente');
            $table->unsignedBigInteger('credit_id');

            $table->foreign('credit_id')->references('id')->on('credits');
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
        Schema::dropIfExists('installments');
    }
};