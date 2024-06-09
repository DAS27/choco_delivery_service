<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Providers;

use App\Providers\AppServiceProvider;

final class OrderServiceProvider extends AppServiceProvider
{
    private const MIGRATIONS_PATH = 'databases/migrations';

    private const CONFIGS_PATH = 'configs';

    private const MODULE_PREFIX = 'order';

    private const CONFIGS = [];

    public function boot(): void
    {
        $this->loadMigrations();
    }

    public function register(): void
    {
        $this->registerConfigs();
        $this->app->register(OrderDIServiceProvider::class);
    }

    private function modulePath(string $path): string
    {
        return sprintf('%s/../../%s', __DIR__, $path);
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->modulePath(self::MIGRATIONS_PATH));
    }

    private function registerConfigs(): void
    {
        $modulePath = $this->modulePath(self::CONFIGS_PATH);
        foreach (self::CONFIGS as $config) {
            $this->mergeConfigFrom(
                "$modulePath/$config.php",
                self::MODULE_PREFIX . ".$config"
            );
        }
    }
}
