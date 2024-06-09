<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\Order\Repositories\CreateOrderRepository;
use SmartDelivery\Order\Repositories\Impl\CreateOrderRepositoryImpl;
use SmartDelivery\Order\Service\CreateOrderService;
use SmartDelivery\Order\Service\Impl\CreateOrderServiceImpl;

final class OrderDIServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        //Repositories
        CreateOrderRepository::class => CreateOrderRepositoryImpl::class,

        //Services
        CreateOrderService::class => CreateOrderServiceImpl::class,

        //Use Cases
    ];
}
