<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Database\Providers;

use Illuminate\Support\ServiceProvider;
use SmartDelivery\Core\Database\Contracts\TransactionInterface;
use SmartDelivery\Core\Database\IlluminateTransaction;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            TransactionInterface::class,
            IlluminateTransaction::class
        );
    }

    public function provides(): array
    {
        return [
            TransactionInterface::class,
        ];
    }
}
