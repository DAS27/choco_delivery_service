<?php

declare(strict_types=1);

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
        Schema::create('raketa_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_id');
            $table->string('warehouse_order_id')->nullable();
            $table->string('phone');
            $table->json('address');
            $table->string('delivery_service_name');
            $table->string('order_planned_at')->nullable();
            $table->string('order_created_at');
            $table->string('total_amount');
            $table->json('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raketa_orders');
    }
};
