<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('name');
            $table->string('last_name');
            $table->string('title');
            $table->string('email')->unique();
            $table->string('member_type');
            $table->decimal('saldo', 10, 2)->nullable();
            $table->enum('status', ['solvente', 'insolvente'])->default('solvente');
            $table->string('cel');
            $table->string('accion');
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
};
