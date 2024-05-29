<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\ProcessOrderStatusHookUseCase;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AddressDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\ContactInfoDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\PointDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\ProductDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\TaskDto;
use SmartDelivery\HttpClients\ChocoDostavka\Enums\TransportTypeEnum;
use SmartDelivery\Main\Controllers\AbstractController;

final class ChocoDostavkaController extends AbstractController
{
    public function __construct(
        private readonly JobDispatcherInterface $jobDispatcher
    ) {}

    public function createOrder(
        Request $request,
        CreateOrderUseCase $createOrderUseCase,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('[ChocoDostavkaController] Incoming SD order request', $request->all());

        $createOrderUseCase->handle(

        );

        return $this->sendResponse(['data' => 'Ok']);
    }
    public function orderStatusHook(
        Request $request,
        ProcessOrderStatusHookUseCase $processOrderStatusHookUseCase,
        LoggerInterface $logger
    ):void {
        /*$logger->info('[ChocoDostavkaController] Incoming order status hook', $request->all());


        foreach ($request->get('orders') as $order) {
            if ($order['status'] === OrderStatusEnum::ASSIGNED->value) {
                $this->jobDispatcher->dispatch(
                    new ChocoDostavkaCreateOrderJob(
                        $order['id'],
                        $order['address'],
                        $order['comment'],
                        $order['price'],
                        $order['point_a'],
                        $order['point_b'],
                        $order['status'],
                        $order['transport_type']
                    );
            }
        }*/
    }
}
