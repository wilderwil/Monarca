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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('tipo_rif',[null,'V','J','G'])->nullable();
            $table->string('rif')->unique()->nullable();
            $table->string('email');
            $table->unsignedInteger('cel');
            $table->string('direccion');
            $table->string('referencia')->nullable();
            $table->unsignedInteger('cel_referencia')->nullable();
            $table->string('image',255)->nullable();
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
        Schema::dropIfExists('clients');
    }
};