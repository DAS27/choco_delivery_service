<?php

declare(strict_types=1);

namespace SmartDelivery\Core\EventDispatcher\Providers;

use Illuminate\Support\ServiceProvider;
use SmartDelivery\Core\EventDispatcher\EventDispatcherInterface;
use SmartDelivery\Core\EventDispatcher\LaravelEventDispatcher;

final class EventDispatcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EventDispatcherInterface::class, LaravelEventDispatcher::class);
    }
}
