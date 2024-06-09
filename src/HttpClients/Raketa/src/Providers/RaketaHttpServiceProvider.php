<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClient;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\HttpClients\Raketa\Repositories\Impl\RedisTokenStorageRepositoryImpl;
use SmartDelivery\HttpClients\Raketa\Repositories\TokenStorageRepository;
use SmartDelivery\HttpClients\Raketa\Services\GetAccessTokenService;
use SmartDelivery\HttpClients\Raketa\Services\Impl\GetAccessTokenServiceImpl;

final class RaketaHttpServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        TokenStorageRepository::class => RedisTokenStorageRepositoryImpl::class,
        GetAccessTokenService::class => GetAccessTokenServiceImpl::class,
        RaketaHttpClientInterface::class => RaketaHttpClient::class,
    ];

    private const CONFIGS_PATH = 'configs';

    private const MODULE_PREFIX = 'raketa-http-client';

    private const CONFIGS = [
        'base'
    ];

    public function register(): void
    {
        $this->registerConfigs();
        $this->registerDI();
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

    private function registerDI(): void
    {
        $env = env('APP_ENV', 'production');

        $token = match ($env) {
            'local', 'staging' => config('choco-dostavka.base.dev.token'),
            default => config('choco-dostavka.base.prod.token'),
        };

        $apiUrl = match ($env) {
            'local', 'staging' => config('choco-dostavka.base.dev.api_url'),
            default => config('choco-dostavka.base.prod.token'),
        };

        $this->app->when(RaketaHttpClientInterface::class)
            ->needs('$apiUrl')
            ->give($apiUrl);

        $this->app->when(RaketaHttpClientInterface::class)
            ->needs('$token')
            ->give($token);
    }
}
