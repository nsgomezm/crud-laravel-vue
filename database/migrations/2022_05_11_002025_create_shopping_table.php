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
        Schema::create('shoppings', function (Blueprint $table) {
            $table->id();
            $table->integer('sum');
            $table->integer('sum_iva');
            $table->integer('amount');
            $table->integer('sum_all');
            $table->string('comments');
            $table->timestamps();
            $table->foreignId('id_bills')->constrained('bills');
            $table->foreignId('id_producto')->constrained('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppings');
    }
};
