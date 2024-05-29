<?php

declare(strict_types=1);

namespace SmartDelivery\Core\JobDispatcher;

use DateTime;

interface JobDispatcherInterface
{
    public function dispatch(BaseJob $job): void;

    public function dispatchIntDelay(BaseJob $job, int $delay = null): void;

    public function dispatchDateTimeDelay(BaseJob $job, DateTime $delay = null): void;
}
