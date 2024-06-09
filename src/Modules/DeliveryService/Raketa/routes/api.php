<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SmartDelivery\DeliveryService\Raketa\Controllers\RaketaController;

Route::controller(RaketaController::class)->group(function () {
    Route::post('/create-order', 'createOrder')->name('raketa.create.order');
    Route::post('/hook/orders/status', 'orderStatusHook')->name('raketa.hook.orders.status');
});
