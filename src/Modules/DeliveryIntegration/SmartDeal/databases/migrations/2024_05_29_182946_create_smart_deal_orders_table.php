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
        Schema::create('smart_deal_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('point_a');
            $table->json('point_b');
            $table->json('products');
            $table->string('phone');
            $table->string('planned_datetime')->nullable();
            $table->integer('external_order_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_deal_orders');
    }
};
