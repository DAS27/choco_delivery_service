<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal\src\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\HttpClients\SmartDeal\SmartDealHttpClient;
use SmartDelivery\HttpClients\SmartDeal\SmartDealHttpClientInterface;

final class SmartDealHttpServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        SmartDealHttpClientInterface::class => SmartDealHttpClient::class
    ];

    private const CONFIGS_PATH = 'configs';

    private const MODULE_PREFIX = 'raketa-http-client';

    private const CONFIGS = [
        'base'
    ];

    public function register(): void
    {
        $this->registerConfigs();
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
