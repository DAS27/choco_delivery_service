<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SmartDelivery\Order\Controllers\OrderController;

Route::controller(OrderController::class)->group(function () {
    Route::post('/create', 'createOrder')->name('create.order');
    Route::post('/status-hook', 'orderStatusHook')->name('status-hook.order');
    Route::post('/cancel', 'cancelOrder')->name('cancel.order');
});
