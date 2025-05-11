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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->integer('tenant_id')->index();
            $table->string('name');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')
                ->onDelete('cascade');
            $table->string('sku')->nullable()->unique();
            $table->string('upc')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->decimal('min_stock', 10, 2)->default(0);
            $table->decimal('max_stock', 10, 2)->default(0);
            $table->string('stock_unit')->default('g');
            $table->decimal('width', 10, 2)->default(0);
            $table->decimal('height', 10, 2)->default(0);
            $table->decimal('depth', 10, 2)->default(0);
            $table->string('dimensions_unit')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_taxable')->default(false);
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
