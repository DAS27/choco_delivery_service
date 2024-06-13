<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryService\Raketa\UseCases\ProcessOrderStatusHookUseCase;
use SmartDelivery\Main\Controllers\AbstractController;
use SmartDelivery\Order\Dto\RequestOrderDto;

final class OrderController extends AbstractController
{
    public function __construct(
        private readonly JobDispatcherInterface $jobDispatcher
    ) {}

    public function createOrder(
        Request $request,
        CreateOrderUseCase $createOrderUseCase,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('[OrderController] Incoming create order request', $request->all());

        $createOrderUseCase->handle(new RequestOrderDto(
            order_id: $request->get('order_id'),
            warehouse_order_id: $request->get('all_style_order_id'),
            phone: $request->get('phone'),
            address: $request->get('address'),
            delivery_service_name: $request->get('delivery_service_name'),
            order_created_at: $request->get('created_at'),
            total_amount: $request->get('total_amount'),
            products: $request->get('products'),
            order_planned_at: $request->get('planned_at'),
        ));

        return $this->sendResponse(['data' => 'Ok']);
    }
    public function orderStatusHook(
        Request $request,
        ProcessOrderStatusHookUseCase $processOrderStatusHookUseCase,
        LoggerInterface $logger
    ):void {
        /*$logger->info('[RaketaController] Incoming order status hook', $request->all());


        if ($request->get('status') === StatusEnum::SUCCESS->value) {

        }

        foreach ($request->get('orders') as $order) {
            if ($order['status'] === OrderStatusEnum::ASSIGNED->value) {
                $this->jobDispatcher->dispatch(
                    new RaketaCreateOrderJob(
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
