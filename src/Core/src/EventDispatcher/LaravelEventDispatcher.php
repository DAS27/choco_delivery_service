<?php

declare(strict_types=1);

namespace SmartDelivery\Core\EventDispatcher;

final class LaravelEventDispatcher implements EventDispatcherInterface
{
    public function dispatch(BaseEvent $event): void
    {
        event($event);
    }
}
