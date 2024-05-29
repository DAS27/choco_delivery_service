<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\ChocoDostavka;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\ChocoDostavka\DTO\CreateOrderDto;
use SmartDelivery\HttpClients\ChocoDostavka\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\ChocoDostavka\Enums\OrderGroupStatusEnum;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\OrderGroupResponse;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\GetAccessTokenResponse;
use SmartDelivery\HttpClients\ChocoDostavka\Responses\OrderResponse;
use SmartDelivery\HttpClients\ChocoDostavka\Services\GetAccessTokenService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final readonly class ChocoDostavkaHttpClient implements ChocoDostavkaHttpClientInterface
{
    private const GET_ACCESS_TOKEN = '/api-gate/v0/common/api-token-refresh';
    private const CREATE_ORDER = '/api-gate/v0/deliveries/groups';
    private const GET_ORDER_DETAIL = '/api-gate/v0/deliveries/groups/group_id';
    private const CANCEL_ORDER = '/api-gate/v0/deliveries/cancel-group/group_id';

    public function __construct(
        private GetAccessTokenService $getAccessTokenService,
        private Client $client,
        private string $apiUrl,
        private string $accessToken,
        private string $refreshAccessToken,
    ) {}

    public function getHeaders(): array
    {
        return [
            'Authorization' => 'JWT ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ];
    }

    public function getAccessToken(): string
    {
        return $this->getAccessTokenService->handle($this->accessToken, $this->refreshAccessToken);
    }

    public function validateResponse(ResponseInterface $response): void {
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new UnexpectedErrorException(
                $response->getBody()->getContents(),
                $response->getStatusCode()
            );
        }
    }

    public function createOrder(CreateOrderDto $createOrderDto): OrderGroupResponse
    {
        $formParams = [
            'transport_type' => $createOrderDto->transportType->value,
            'callback_url' => $createOrderDto->callbackUrl,
            'points' => [
                [
                    'merchant_order_id' => $createOrderDto->pointA->merchant_order_id,
                    'address' => [
                        'street' => $createOrderDto->pointA->address->street,
                        'building' => $createOrderDto->pointA->address->building,
                    ],
                    'task' => [
                        'task_id' => $createOrderDto->pointA->task->task_id,
                        'comment' => $createOrderDto->pointA->task->comment
                    ],
                    'items' => $createOrderDto->pointA->products
                ],
                [
                    'contact_info' => [
                        'phone_number' => $createOrderDto->pointB->phone_number
                    ],
                    'address' => [
                        'street' => $createOrderDto->pointB->address->street,
                        'building' => $createOrderDto->pointB->address->building,
                    ],
                ],
            ],
        ];

        try {
            $response = $this->client->request('POST', $this->apiUrl . self::CREATE_ORDER, [
                RequestOptions::JSON => $formParams,
                'headers' => $this->getHeaders()
            ]);
        } catch (GuzzleException $e) {
            Log::critical('Request params', $formParams);
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
        try {
            $this->validateResponse($response);
        } catch (UnexpectedErrorException $e) {
            Log::critical('Request params', $formParams);
            throw  $e;
        }

        try {
            $responseBody = $response->getBody()->getContents();
            $responseBodyArr = json_decode($responseBody, true);

            return new OrderGroupResponse(
                group_id: $responseBodyArr['group_detail']['id'],
                status: OrderGroupStatusEnum::tryFrom((string) $responseBodyArr['group_detail']['status']),
                orders: array_map(
                    fn ($order) => new OrderResponse(
                        id: $order['id'],
                        status: $order['status'],
                        price: $order['price'],
                        sms_code: $order['sms_code'],
                        merchant_order_id: $order['merchant_order_id'],
                        tracking_short_link: $order['tracking_short_link'],
                        tracking_uuid: $order['tracking_uuid'],
                        courier_name: $order['courier_name'],
                        courier_phone: $order['courier_phone'],
                        was_returned: $order['was_returned'],
                    ),
                    $responseBodyArr['group_detail']['orders']
                )
            );
        } catch (Throwable $e) {
            Log::critical('Request params', $formParams);
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }

    public function getOrderDetail(string $orderId): OrderResponse
    {
        // TODO: Implement getOrderDetail() method.
    }

    public function cancelOrder(string $orderId): void
    {
        // TODO: Implement cancelOrder() method.
    }

    public function obtainAccessToken(AccessTokenDto $accessTokenDto): GetAccessTokenResponse
    {
        $formParams = [
            'refresh' => $accessTokenDto->refresh_token,
        ];

        try {
            $response = $this->client->request('POST', $this->apiUrl . self::GET_ACCESS_TOKEN, [
                RequestOptions::JSON => $formParams,
                'headers' => $this->getHeaders()
            ]);
        } catch (GuzzleException $e) {
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }

        $this->validateResponse($response);

        try {
            $responseBody = $response->getBody()->getContents();
            $responseBodyArr = json_decode($responseBody, true);

            return new GetAccessTokenResponse(
                access: $responseBodyArr['access'],
                refresh: $responseBodyArr['refresh']
            );
        } catch (Throwable $e) {
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }
}
