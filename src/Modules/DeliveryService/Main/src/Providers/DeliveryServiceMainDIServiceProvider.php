<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Providers;

use Illuminate\Support\ServiceProvider;
use SmartDelivery\DeliveryService\Main\Factories\DeliveryServiceProviderFactory;
use SmartDelivery\DeliveryService\Main\UseCase\CancelExternalOrderUseCase;
use SmartDelivery\DeliveryService\Main\UseCase\CreateExternalOrderUseCase;
use SmartDelivery\DeliveryService\Main\UseCase\Impl\CancelExternalOrderUseCaseImpl;
use SmartDelivery\DeliveryService\Main\UseCase\Impl\CreateExternalOrderUseCaseImpl;

final class DeliveryServiceMainDIServiceProvider extends ServiceProvider
{
    public array $bindings = [
        //Factories
        DeliveryServiceProviderFactory::class => DeliveryServiceProviderFactory::class,

        //Repositories

        //Services

        //UseCases
        CreateExternalOrderUseCase::class => CreateExternalOrderUseCaseImpl::class,
        CancelExternalOrderUseCase::class => CancelExternalOrderUseCaseImpl::class,
    ];
}
