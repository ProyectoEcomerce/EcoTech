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
            $table->id();
            $table->timestamps();
            $table->string('name', 45);
            $table->decimal('price', 8,2);
            $table->decimal('offerPrice')->nullable();
            $table->integer('voltage');
            $table->integer('guarantee');
            $table->decimal('manufacturing_price', 8,2);
            $table->decimal('weigth', 8,2);
            $table->string('materials', 45);
            $table->text('description');
            $table->string('dimensions', 45);
            $table->string('battery', 65);
            $table->string('engine', 65);
            $table->string('components', 105);
            $table->integer('favouriteCounter')->default(0);
            $table->boolean('show')->default(true);
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
