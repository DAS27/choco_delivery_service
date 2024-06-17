<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\SmartDeal\Dto\OrderStatusDto;

final readonly class SmartDealHttpClient implements SmartDealHttpClientInterface
{
    private const SEND_COURIER_NAME = '/api-gate/v0/deliveries/groups';

    public function __construct(
        private Client $client,
        private string $apiUrl
    ) {}

    public function sendOrderStatus(OrderStatusDto $dto): void
    {
        try {
            $this->client->request('POST', $this->apiUrl . self::SEND_COURIER_NAME, [
                RequestOptions::JSON => $dto->toArray(),
            ]);
        } catch (GuzzleException $e) {
            Log::critical('Request params', $dto->toArray());
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }
}
