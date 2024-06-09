<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\DeliveryService\Main\Factories\DeliveryServiceProviderFactory;
use SmartDelivery\DeliveryService\Raketa\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryService\Raketa\Repositories\Impl\CreateOrderRepositoryImpl;
use SmartDelivery\DeliveryService\Raketa\Service\CreateOrderService;
use SmartDelivery\DeliveryService\Raketa\Service\Impl\CreateOrderServiceImpl;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryService\Raketa\UseCases\Impl\CreateOrderUseCaseImpl;

final class RaketaDIServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        //Factories
        DeliveryServiceProviderFactory::class => DeliveryServiceProviderFactory::class,

        //Repositories
        CreateOrderRepository::class => CreateOrderRepositoryImpl::class,

        //Services
        CreateOrderService::class => CreateOrderServiceImpl::class,

        //Use Cases
        CreateOrderUseCase::class => CreateOrderUseCaseImpl::class,
    ];
}
