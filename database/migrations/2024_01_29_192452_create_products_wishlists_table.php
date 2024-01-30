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
        Schema::create('products_wishlists', function (Blueprint $table) {
            $table->id('product_wishlist_id');
            $table->timestamps();
            $table->foreignId('wishlist_id')->references('wishlist_id')->on('wishlists');
            $table->foreignId('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_wishlists');
    }
};
