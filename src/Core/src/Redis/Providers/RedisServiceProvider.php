<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Redis\Providers;

use Illuminate\Support\ServiceProvider;
use Predis\Client;

class RedisServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfigs();
        $this->registerServices();
    }

    public function provides(): array
    {
        return [
            Client::class,
        ];
    }

    private function registerServices(): void
    {
        $this->app->bind(
            Client::class,
            static function () {
                return new Client(
                    [
                        'url' => config('core.redis.url'),
                        'host' => config('core.redis.host'),
                        'password' => config('core.redis.password'),
                        'port' => config('core.redis.port'),
                        'database' => config('core.redis.database'),
                    ]
                );
            }
        );
    }

    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(
            \dirname(__DIR__, 3) . '/configs/redis.php',
            'core.redis'
        );
    }
}
