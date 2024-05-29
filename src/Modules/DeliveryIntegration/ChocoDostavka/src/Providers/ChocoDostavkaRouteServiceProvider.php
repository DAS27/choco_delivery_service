<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Providers;

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;

final class ChocoDostavkaRouteServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    private function mapApiRoutes(): void
    {
        Route::prefix('api/choco-dostavka')
            ->middleware('api')
            ->namespace('SmartDelivery\DeliveryIntegration\ChocoDostavka\Controllers')
            ->group(dirname(__DIR__, 2) . '/routes/api.php');
    }
}
