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
            $table->integer('offerPrice')->nullable();
            $table->string('voltage', 45);
            $table->string('guarantee', 45);
            $table->string('manufacturing_price', 45);
            $table->string('weigth', 45);
            $table->string('materials', 45);
            $table->text('description');
            $table->string('dimensions', 45);
            $table->string('battery', 45);
            $table->string('engine', 45);
            $table->string('components', 45);
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
