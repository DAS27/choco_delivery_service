<?php

declare(strict_types=1);

namespace SmartDelivery\Core\JobDispatcher\Providers;

use Illuminate\Support\ServiceProvider;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\Core\JobDispatcher\LaravelJobDispatcher;

final class JobDispatcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(JobDispatcherInterface::class, LaravelJobDispatcher::class);
    }

    public function provides(): array
    {
        return [
            JobDispatcherInterface::class,
        ];
    }
}
