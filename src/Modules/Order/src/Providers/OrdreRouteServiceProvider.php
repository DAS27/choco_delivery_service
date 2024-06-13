<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Providers;

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Route;

final class OrdreRouteServiceProvider extends AppServiceProvider
{
    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    private function mapApiRoutes(): void
    {
        Route::prefix('api/order')
            ->middleware('api')
            ->namespace('SmartDelivery\Order\Controllers')
            ->group(dirname(__DIR__, 2) . '/routes/api.php');
    }
}
