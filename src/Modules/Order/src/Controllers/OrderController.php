<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\DeliveryService\Raketa\Enums\OrderStatusEnum;
use SmartDelivery\DeliveryService\Raketa\UseCases\SendCourierInfoUseCase;
use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;
use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;
use SmartDelivery\Main\Controllers\AbstractController;
use SmartDelivery\Order\Dto\RequestOrderDto;
use SmartDelivery\Order\Jobs\CreateOrderJob;

final class OrderController extends AbstractController
{
    public function __construct(
        private readonly JobDispatcherInterface $jobDispatcher
    ) {}

    public function createOrder(
        Request $request,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('[OrderController] Incoming create order request', $request->all());

        $this->jobDispatcher->dispatch(
            new CreateOrderJob(
                new RequestOrderDto(
                    order_id: (int) $request->get('order_id'),
                    merchant_name: $request->get('merchant_name'),
                    warehouse_order_id: (int) $request->get('all_style_order_id'),
                    recipient_phone: $request->get('phone_2'),
                    sender_phone: $request->get('phone_1'),
                    delivery_address: $request->get('address'),
                    delivery_service_name: $request->get('delivery_service_name'),
                    order_created_at: $request->get('created_at'),
                    total_amount: $request->get('total_amount'),
                    items: $request->get('products'),
                    order_planned_at: $request->get('planned_at'),
                )
            )
        );

        return $this->sendResponse(['message' => 'Ok']);
    }
    public function orderStatusHook(
        Request $request,
        SendCourierInfoUseCase $sendCourierInfoUseCase,
        LoggerInterface $logger
    ):void {
        $logger->info('[RaketaController] Incoming order status hook', $request->all());

        if ($request->get('state') === OrderGroupStatusEnum::IN_THE_WAY->value) {
            foreach ($request->get('orders') as $order) {
                if ($order['status'] === OrderStatusEnum::ASSIGNED->value) {
                    $sendCourierInfoUseCase->handle(new OrderStatusDto(
                        order_id: (int) $request->get('id')
                    ));
                }
            }
        }

    }
}
