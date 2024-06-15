<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;

final class SmartDealHttpClient implements SmartDealHttpClientInterface
{
    public function __construct(
        private Client $client,
    ) {}

    public function sendOrderStatus(OrderStatusDto $dto): void
    {
        try {
            $response = $this->client->request('POST', $this->apiUrl . self::CREATE_ORDER, [
                RequestOptions::JSON => $dto->toArray(),
            ]);
        } catch (GuzzleException $e) {
            Log::critical('Request params', $dto->toArray());
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }
}
