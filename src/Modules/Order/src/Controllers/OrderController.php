<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\DeliveryService\Raketa\Enums\OrderStatusEnum;
use SmartDelivery\DeliveryService\Raketa\UseCases\SendCourierInfoUseCase;
use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;
use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;
use SmartDelivery\Main\Controllers\AbstractController;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Jobs\CreateOrderJob;
use SmartDelivery\Order\Requests\CancelOrderRequest;
use SmartDelivery\Order\Requests\CreateOrderRequest;

final class OrderController extends AbstractController
{
    public function __construct(
        private readonly JobDispatcherInterface $jobDispatcher
    ) {}

    public function createOrder(
        CreateOrderRequest $request,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('[OrderController] Incoming create order request', $request->all());

        $this->jobDispatcher->dispatch(
            new CreateOrderJob(
                new RequestOrderDto(
                    order_id: (int) $request->get('order_id'),
                    merchant_name: $request->get('merchant_name'),
                    warehouse_order_id: (int) $request->get('all_style_order_id'),
                    recipient_phone: $request->get('recipient_phone'),
                    sender_phone: $request->get('sender_phone'),
                    delivery_address: $request->get('delivery_address'),
                    delivery_service_name: $request->get('delivery_service_name'),
                    order_created_at: $request->get('created_at'),
                    total_amount: $request->get('total_amount'),
                    items: $request->get('items'),
                    order_planned_at: $request->get('planned_at'),
                )
            )
        );

        return $this->sendResponse(['message' => 'Ok']);
    }

    public function cancelOrder(
        CancelOrderRequest $request,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('[OrderController] Incoming cancel order request', $request->all());

        return $this->sendResponse(['message' => 'Ok']);
    }

    #[NoReturn] public function orderStatusHook(
        Request $request,
        SendCourierInfoUseCase $sendCourierInfoUseCase,
        LoggerInterface $logger
    ):void {
        $logger->info('[RaketaController] Incoming order status hook', $request->all());

        if ($request->get('state') === OrderGroupStatusEnum::IN_THE_WAY->value) {
            foreach ($request->get('orders') as $order) {
                if ($order['status'] === OrderStatusEnum::ASSIGNED->value) {
                    $sendCourierInfoUseCase->handle(new OrderStatusDto(
                        order_id: (int) $request->get('id'),
                        external_order_id: (int) $order['merchant_order_id'],
                        status: OrderStatusEnum::tryFrom($request->get('state')),
                        courier_name: $request->get('courier_name'),
                        courier_phone: $request->get('courier_phone'),
                    ));
                }
            }
        }
    }
}
