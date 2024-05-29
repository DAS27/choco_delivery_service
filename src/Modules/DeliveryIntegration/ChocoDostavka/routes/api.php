<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Controllers\ChocoDostavkaController;

Route::post('/create-order', [ChocoDostavkaController::class, 'createOrder']);
Route::post('/hook/orders/status', [ChocoDostavkaController::class, 'orderStatusHook']);
