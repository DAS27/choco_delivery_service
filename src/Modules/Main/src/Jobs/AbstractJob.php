<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Jobs;

use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\BaseJob;
use Throwable;

abstract class AbstractJob extends BaseJob
{
    protected function logInfo(
        LoggerInterface $logger,
        string $title,
        array $data = []
    ): void {
        $logger->info(
            $title,
            [
                'data' => $data,
                'extra' => [
                    'queue' => $this->queue,
                    'attempts' => $this->attempts(),
                ],
            ]
        );
    }

    protected function logError(
        LoggerInterface $logger,
        Throwable $exception,
        string $title,
        array $data = []
    ): void {
        $logger->error(
            $title,
            [
                'data' => $data,
                'extra' => [
                    'queue' => $this->queue,
                    'attempts' => $this->attempts(),
                ],
                'exception' => [
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'trace' => $exception->getTraceAsString(),
                ]
            ]
        );
    }
}
