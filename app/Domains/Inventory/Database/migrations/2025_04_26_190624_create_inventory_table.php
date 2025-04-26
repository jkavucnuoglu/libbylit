<?php

use App\Domains\Inventory\Enum\SupplierEnum;
use App\Enums\StatusEnum;
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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->integer('tenant_id')->index();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('description')->nullable();
            $table->enum('type', array_map(fn($type) => $type->value(), SupplierEnum::cases()))
                ->default(SupplierEnum::FINISHED_GOOD->value());
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->enum('status', array_map(fn($status) => $status->value(), StatusEnum::cases()))
                ->default(StatusEnum::ACTIVE->value());
            $table->string('stripe_product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
