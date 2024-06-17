<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\SmartDeal;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\SmartDeal\Dto\CourierInfoDto;

final readonly class SmartDealHttpClient implements SmartDealHttpClientInterface
{
    private const SEND_COURIER_NAME = "/api/orders/%s/assign-courier";

    public function __construct(
        private Client $client,
        private string $apiUrl
    ) {}

    public function sendCourierInfo(CourierInfoDto $courierInfoDto): void
    {
        try {
            $url = sprintf($this->apiUrl . self::SEND_COURIER_NAME, $courierInfoDto->external_order_id);

            $this->client->request('POST', $url, [
                RequestOptions::JSON => $courierInfoDto->toArray(),
            ]);
        } catch (GuzzleException $e) {
            Log::critical('Request params', $courierInfoDto->toArray());
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }
}
