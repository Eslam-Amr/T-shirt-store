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
            $table->string('stock');
            $table->string('price');
            $table->string('discount');
            $table->string('price_after_discount');
            $table->string('status');
            $table->string('name');
            $table->string('description');
            $table->string('desinger');
            $table->string('bestSeller');
            $table->string('image');
            $table->foreignUuid('designer_id')->constrained('designers')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
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
