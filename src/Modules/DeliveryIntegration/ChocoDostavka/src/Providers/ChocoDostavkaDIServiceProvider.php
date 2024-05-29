<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Repositories\Impl\CreateOrderRepositoryImpl;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Service\CreateOrderService;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\Service\Impl\CreateOrderServiceImpl;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\Impl\CreateOrderUseCaseImpl;

final class ChocoDostavkaDIServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        //Repositories
        CreateOrderRepository::class => CreateOrderRepositoryImpl::class,

        //Services
        CreateOrderService::class => CreateOrderServiceImpl::class,

        //Use Cases
        CreateOrderUseCase::class => CreateOrderUseCaseImpl::class,
    ];
}
