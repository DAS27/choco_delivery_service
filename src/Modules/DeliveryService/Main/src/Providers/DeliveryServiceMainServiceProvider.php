<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Providers;

use Illuminate\Support\ServiceProvider;

final class DeliveryServiceMainServiceProvider extends ServiceProvider
{
    private const CONFIGS_PATH = 'configs';

    private const MODULE_PREFIX = 'delivery-service';

    private const MIGRATIONS_PATH = 'database/migrations';

    private const CONFIGS = [
    ];

    public function register(): void
    {
        $this->registerConfigs();
        $this->app->register(DeliveryServiceMainDIServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrations();
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->modulePath(self::MIGRATIONS_PATH));
    }

    private function modulePath(string $path): string
    {
        return sprintf('%s/../../%s', __DIR__, $path);
    }

    private function registerConfigs(): void
    {
        $modulePath = $this->modulePath(self::CONFIGS_PATH);
        foreach (self::CONFIGS as $config) {
            $this->mergeConfigFrom(
                "{$modulePath}/{$config}.php",
                self::MODULE_PREFIX . ".{$config}"
            );
        }
    }
}
