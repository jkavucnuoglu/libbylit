<?php

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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('tenant_id')->index();
            $table->string('account_number')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->jsonb('address')->nullable();

            $table->enum('status', array_map(fn($type) => $type->value(), StatusEnum::cases()))
                ->default(StatusEnum::ACTIVE->value());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
