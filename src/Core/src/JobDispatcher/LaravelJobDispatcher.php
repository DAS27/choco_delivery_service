<?php

declare(strict_types=1);

namespace SmartDelivery\Core\JobDispatcher;

use DateTime;
use Illuminate\Contracts\Bus\Dispatcher;

final class LaravelJobDispatcher implements JobDispatcherInterface
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(BaseJob $job): void
    {
        $this->dispatcher->dispatch($job);
    }

    public function dispatchIntDelay(BaseJob $job, int $delay = null): void
    {
        $this->dispatcher->dispatch($job->delay($delay));
    }

    public function dispatchDateTimeDelay(BaseJob $job, DateTime $delay = null): void
    {
        $this->dispatcher->dispatch($job->delay($delay));
    }
}
