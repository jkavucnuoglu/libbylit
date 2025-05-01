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
            $table->uuid();
            $table->integer('tenant_id')->index();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->nullable()->unique();
            $table->string('upc')->nullable();
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->integer('weight')->default(0);
            $table->string('weight_unit')->default('g');
            $table->string('width')->default(0);
            $table->string('height')->default(0);
            $table->string('length')->default(0);
            $table->string('depth')->default(0);
            $table->string('dimension_unit')->default('cm');
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
