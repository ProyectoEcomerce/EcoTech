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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->timestamps();
            $table->decimal('price', 2);
            $table->integer('offerPrice')->nullable();
            $table->string('voltage');
            $table->string('guarantee');
            $table->string('manufacturing_price');
            $table->string('weigth');
            $table->string('materials');
            $table->string('description', 300);
            $table->string('dimensions');
            $table->string('battery');
            $table->string('engine');
            $table->string('Components', 45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
