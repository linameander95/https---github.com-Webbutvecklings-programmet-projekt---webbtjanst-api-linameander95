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
        Schema::create('skincares', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('description', 255);
            $table->integer('quantity');
            $table->integer('price');
            $table->string('crueltyfree', 64);
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
        Schema::dropIfExists('skincares');
    }
};
