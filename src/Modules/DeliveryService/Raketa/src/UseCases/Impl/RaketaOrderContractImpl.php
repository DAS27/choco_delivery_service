<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Raketa\UseCases\Impl;

use SmartDelivery\DeliveryService\Main\Contracts\CreateOrderContract;
use SmartDelivery\DeliveryService\Main\Contracts\Dto\CreateOrderResponseDto;
use SmartDelivery\DeliveryService\Main\Dto\CreateExternalOrderDto;
use SmartDelivery\DeliveryService\Main\Enums\DeliveryServiceEnum;
use SmartDelivery\DeliveryService\Main\Exceptions\CantCreateExternalOrderException;
use SmartDelivery\DeliveryService\Raketa\Dto\AddressDto;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\DeliveryService\Raketa\Dto\PointDto;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\Raketa\Enums\TransportTypeEnum;
use SmartDelivery\HttpClients\Raketa\RaketaHttpClientInterface;

final readonly class RaketaOrderContractImpl implements CreateOrderContract
{
    public function __construct(
        private RaketaHttpClientInterface $httpClient,
    ) {}
    public function handle(CreateExternalOrderDto $externalOrderDto): CreateOrderResponseDto
    {
        try {
            $response = $this->httpClient->createOrder(
                new CreateOrderDto(
                    transportType: TransportTypeEnum::CAR,
                    points: array_map(function (array $point) use ($externalOrderDto) {
                        return new PointDto(
                            phone_number: $externalOrderDto->phone,
                            address: new AddressDto(
                                street: $point['street'],
                                building: $point['building'],
                            ),
                            products: $externalOrderDto->products,
                            merchant_order_id: $externalOrderDto->warehouse_order_id,
                        );
                    }, $externalOrderDto->products)
                )
            );
        } catch (UnexpectedErrorException $e) {
            throw new CantCreateExternalOrderException($e->getMessage(), $e->getCode(), $e);
        }

        /*try {
            $this->createWebscardCardService->handle(
                new CreateWebscardCardDto(
                    $response->cardId,
                    $request->startBalance,
                    self::BIN,
                    null,
                    false
                )
            );
        } catch (Throwable $exception) {
            throw new CardIssuedButException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return new IssueCardResponse(
            $response->cardId,
            $request->paymentNetworkEnum,
            null,
            null,
            null,
            null,
            Carbon::now()->addMinute(),
        );*/
    }

    public function getProvider(): DeliveryServiceEnum
    {
        return DeliveryServiceEnum::RAKETA;
    }
}
