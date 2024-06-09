<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use SmartDelivery\Core\JobDispatcher\JobDispatcherInterface;
use SmartDelivery\DeliveryService\Raketa\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryService\Raketa\UseCases\ProcessOrderStatusHookUseCase;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\ProductDto;
use SmartDelivery\Main\Controllers\AbstractController;

final class RaketaController extends AbstractController
{
    public function __construct(
        private readonly JobDispatcherInterface $jobDispatcher
    ) {}

    public function createOrder(
        Request $request,
        CreateOrderUseCase $createOrderUseCase,
        LoggerInterface $logger
    ): JsonResponse {
        dd($request->all());
        $logger->info('[RaketaController] Incoming create order request', $request->all());

        $createOrderUseCase->handle(
            new CreateOrderDto(
                phone: $request->get('phone'),
                point_a: new AddressDto(
                    street: $request->get('points')[0]['street'],
                    building: $request->get('points')[0]['building'],
                ),
                point_b: new AddressDto(
                    street: $request->get('points')[1]['street'],
                    building: $request->get('points')[1]['building'],
                ),
                products: array_map(
                    fn($item) => new ProductDto(
                        title: $item['title'],
                        price: $item['price'],
                        count: $item['count']
                    ),
                    $request->get('products')),
                external_order_id: $request->get('order_id'),
                planned_datetime: $request->get('planned_datetime')
            )
        );

        return $this->sendResponse(['data' => 'Ok']);
    }
    public function orderStatusHook(
        Request $request,
        ProcessOrderStatusHookUseCase $processOrderStatusHookUseCase,
        LoggerInterface $logger
    ):void {
        /*$logger->info('[RaketaController] Incoming order status hook', $request->all());


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
