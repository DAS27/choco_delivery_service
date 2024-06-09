<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Providers;

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;

final class RaketaRouteServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    private function mapApiRoutes(): void
    {
        Route::prefix('api/raketa')
            ->middleware('api')
            ->namespace('SmartDelivery\DeliveryService\Raketa\Controllers')
            ->group(dirname(__DIR__, 2) . '/routes/api.php');
    }
}
