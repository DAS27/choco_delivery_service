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
        Schema::create('choco_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('merchant_order_id');
            $table->string('status');
            $table->string('courier_name');
            $table->string('courier_phone');
            $table->string('sms_code');
            $table->integer('price');
            $table->boolean('was_returned');
            $table->string('tracking_short_link');
            $table->string('tracking_uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choco_orders');
    }
};
