<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\SmartDeal\Providers;

use App\Providers\AppServiceProvider;
use SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\CreateOrderRepository;
use SmartDelivery\DeliveryIntegration\SmartDeal\Repositories\Impl\CreateOrderRepositoryImpl;
use SmartDelivery\DeliveryIntegration\SmartDeal\Service\CreateOrderService;
use SmartDelivery\DeliveryIntegration\SmartDeal\Service\Impl\CreateOrderServiceImpl;

final class SmartDealDIServiceProvider extends AppServiceProvider
{
    public array $bindings = [
        //Repositories
        CreateOrderRepository::class => CreateOrderRepositoryImpl::class,

        //Services
        CreateOrderService::class => CreateOrderServiceImpl::class,

        //Use Cases
    ];
}
