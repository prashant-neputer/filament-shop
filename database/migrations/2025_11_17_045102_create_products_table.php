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
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique()->index();
            $table->string('sku', 100)->unique()->nullable();
            $table->decimal('cost_price', 10, 2);
            $table->decimal('mrp', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->string('summary', 1000)->nullable();
            $table->longText('description')->nullable();
            $table->json('attributes')->nullable();
            $table->string('stock_quantity')->default('0');
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false);
            $table->string('sort_order')->nullable()->default('0');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
