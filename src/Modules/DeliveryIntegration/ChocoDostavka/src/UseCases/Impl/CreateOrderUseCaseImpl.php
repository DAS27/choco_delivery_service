<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\Impl;

use SmartDelivery\DeliveryIntegration\ChocoDostavka\UseCases\CreateOrderUseCase;
use SmartDelivery\DeliveryIntegration\SmartDeal\Dto\CreateOrderDto;
use SmartDelivery\DeliveryIntegration\SmartDeal\Service\CreateOrderService as SmartDealCreateOrderService;
use SmartDelivery\HttpClients\ChocoDostavka\ChocoDostavkaHttpClientInterface;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AddressDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\PointDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\TaskDto;
use SmartDelivery\HttpClients\ChocoDostavka\Enums\TransportTypeEnum;

final readonly class CreateOrderUseCaseImpl implements CreateOrderUseCase
{
    public function __construct(
        private SmartDealCreateOrderService $smartDealOrderService,
        private ChocoDostavkaHttpClientInterface $chocoDostavkaHttpClient
    ) {}

    public function handle(
        CreateOrderDto $dto,
    ): void
    {
        $this->smartDealOrderService->handle($dto);

        $chocoDostavkaDto = new \SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto(
                transportType: TransportTypeEnum::CAR,
                pointA: new PointDto(
                    phone_number: $dto->phone,
                    address: new AddressDto(
                            street: $dto->point_a->street,
                            building: $dto->point_a->building,
                        ),
                    products: $dto->products
                ),
                pointB: new PointDto(
                    phone_number: $dto->phone,
                    address: new AddressDto(
                        street: $dto->point_a->street,
                        building: $dto->point_a->building,
                    ),
                    products: $dto->products,
                    merchant_order_id: $dto->external_order_id,
                    task: new TaskDto(
                        task_id: 11398, // Default task id - check product
                        comment: "Проверить товар"
                    ),
                ),
                callbackUrl: 'https://example.com'
        );

        $this->chocoDostavkaHttpClient->createOrder($chocoDostavkaDto);
    }
}
