<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\Impl;

use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto as SmartDealCreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Service\CreateOrderService as SmartDealCreateOrderService;
use SmartDelivery\HttpClients\ChocoDostavka\ChocoDostavkaHttpClientInterface;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AddressDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto as ChocoDostavkaCreateOrderDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\PointDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\TaskDto;
use SmartDelivery\HttpClients\ChocoDostavka\Enums\TransportTypeEnum;
use SmartDelivery\Main\Exceptions\CantStoreException;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private SmartDealCreateOrderService $smartDealOrderService,
//        private ChocoDostavkaHttpClientInterface $chocoDostavkaHttpClient
    ) {}

    public function handle(
        SmartDealCreateOrderDto $dto,
    ): void
    {
        $smartDealOrderEntity = $this->smartDealOrderService->handle($dto);


        if ($smartDealOrderEntity === null) {
            throw new CantStoreException('Failed to create smart deal order');
        }

        $chocoDostavkaDto = new ChocoDostavkaCreateOrderDto(
                transportType: TransportTypeEnum::CAR,
                pointA: new PointDto(
                    phone_number: $smartDealOrderEntity->phone,
                    address: new AddressDto(
                            street: $smartDealOrderEntity->point_a->street,
                            building: $smartDealOrderEntity->point_a->building,
                        ),
                    products: $smartDealOrderEntity->products
                ),
                pointB: new PointDto(
                phone_number: $smartDealOrderEntity->phone,
                    address: new AddressDto(
                        street: $smartDealOrderEntity->point_b->street,
                        building: $smartDealOrderEntity->point_b->building,
                    ),
                    products: $smartDealOrderEntity->products,
                    merchant_order_id: $smartDealOrderEntity->external_order_id,
                    task: new TaskDto(
                        task_id: 11398, // Default task id - check product
                        comment: "Проверить товар"
                    ),
                ),
                callbackUrl: 'https://example.com'
        );

//        $this->chocoDostavkaHttpClient->createOrder($chocoDostavkaDto);
    }
}
