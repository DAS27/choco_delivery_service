<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SmartDelivery\Order\Controllers\OrderController;

Route::controller(OrderController::class)->group(function () {
    Route::post('/create-order', 'createOrder')->name('create.order');
});
