<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\HttpClients\Raketa\RaketaAuthHttpClientInterface;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClient;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;
use SmartDelivery\HttpClients\Raketa\Repositories\Impl\RedisTokenStorageRepositoryImpl;
use SmartDelivery\HttpClients\Raketa\Repositories\TokenStorageRepository;
use SmartDelivery\HttpClients\Raketa\Services\GetAccessTokenService;
use SmartDelivery\HttpClients\Raketa\Services\Impl\GetAccessTokenServiceImpl;
use SmartDelivery\HttpClients\Raketa\Services\Impl\RaketaAuthHttpClientInterfaceImpl;

final class RaketaHttpServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        TokenStorageRepository::class => RedisTokenStorageRepositoryImpl::class,
        GetAccessTokenService::class => GetAccessTokenServiceImpl::class,
        RaketaHttpClientInterface::class => RaketaHttpClient::class,
        RaketaAuthHttpClientInterface::class => RaketaAuthHttpClientInterfaceImpl::class
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

        $token = config('raketa-http-client.base.token');

        $refreshToken = config('raketa-http-client.base.refresh_token');

        $apiUrl = match ($env) {
            'local' => config('raketa-http-client.base.dev.api_url'),
            default => config('raketa-http-client.base.prod.api_url'),
        };

        $this->app->when(RaketaHttpClient::class)
            ->needs('$apiUrl')
            ->give($apiUrl);

        $this->app->when(RaketaHttpClient::class)
            ->needs('$token')
            ->give($token);

        $this->app->when(RaketaHttpClient::class)
            ->needs('$refreshAccessToken')
            ->give($refreshToken);

        $this->app->when(RaketaAuthHttpClientInterfaceImpl::class)
            ->needs('$apiUrl')
            ->give($apiUrl);

        $this->app->when(RaketaAuthHttpClientInterfaceImpl::class)
            ->needs('$token')
            ->give($token);

        $this->app->when(RaketaAuthHttpClientInterfaceImpl::class)
            ->needs('$refreshAccessToken')
            ->give($refreshToken);
    }
}
