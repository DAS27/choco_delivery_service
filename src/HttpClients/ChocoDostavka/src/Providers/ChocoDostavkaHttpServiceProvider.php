<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\HttpClients\ChocoDostavka\ChocoDostavkaHttpClient;
use SmartDelivery\HttpClients\ChocoDostavka\ChocoDostavkaHttpClientInterface;
use SmartDelivery\HttpClients\ChocoDostavka\Repositories\Impl\RedisTokenStorageRepositoryImpl;
use SmartDelivery\HttpClients\ChocoDostavka\Repositories\TokenStorageRepository;
use SmartDelivery\HttpClients\ChocoDostavka\Services\GetAccessTokenService;
use SmartDelivery\HttpClients\ChocoDostavka\Services\Impl\GetAccessTokenServiceImpl;

final class ChocoDostavkaHttpServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        TokenStorageRepository::class => RedisTokenStorageRepositoryImpl::class,
        GetAccessTokenService::class => GetAccessTokenServiceImpl::class,
        ChocoDostavkaHttpClientInterface::class => ChocoDostavkaHttpClient::class,
    ];

    private const CONFIGS_PATH = 'configs';

    private const MODULE_PREFIX = 'choco-dostavka-http-client';

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

        $this->app->when(ChocoDostavkaHttpClientInterface::class)
            ->needs('$apiUrl')
            ->give($apiUrl);

        $this->app->when(ChocoDostavkaHttpClientInterface::class)
            ->needs('$token')
            ->give($token);
    }
}
