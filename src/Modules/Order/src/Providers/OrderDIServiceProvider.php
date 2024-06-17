<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\Order\Repositories\Impl\OrderItemRepositoryImpl;
use SmartDelivery\Order\Repositories\Impl\OrderRepositoryImpl;
use SmartDelivery\Order\Repositories\OrderItemRepository;
use SmartDelivery\Order\Repositories\OrderRepository;
use SmartDelivery\Order\Services\CreateOrderService;
use SmartDelivery\Order\Services\Impl\CreateOrderServiceImpl;
use SmartDelivery\Order\UseCases\CreateOrderUseCase;
use SmartDelivery\Order\UseCases\Impl\CreateOrderUseCaseImpl;

final class OrderDIServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        //Repositories
        OrderRepository::class => OrderRepositoryImpl::class,
        OrderItemRepository::class => OrderItemRepositoryImpl::class,

        //Services
        CreateOrderService::class => CreateOrderServiceImpl::class,

        //Use Cases
        CreateOrderUseCase::class => CreateOrderUseCaseImpl::class,
    ];
}
