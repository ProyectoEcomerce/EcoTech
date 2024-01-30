<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts_products', function (Blueprint $table) {
            $table->id('cart_product_id');
            $table->timestamps();
            $table->foreignId('cart_id')->references('cart_id')->on('carts');
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_products');
    }
};
