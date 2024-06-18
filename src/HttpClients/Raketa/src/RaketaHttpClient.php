<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use SmartDelivery\DeliveryService\Raketa\Dto\CreateOrderDto;
use SmartDelivery\HttpClients\Raketa\Entities\AccessTokenEntity;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\Raketa\Enums\OrderGroupStatusEnum;
use SmartDelivery\HttpClients\Raketa\Responses\OrderGroupResponse;
use SmartDelivery\HttpClients\Raketa\Services\GetAccessTokenService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final readonly class RaketaHttpClient implements RaketaHttpClientInterface
{
    private const CREATE_ORDER = '/api-gate/v0/deliveries/groups';
    private const CANCEL_ORDER = '/api-gate/v0/deliveries/cancel-group';

    public function __construct(
        private GetAccessTokenService $getAccessTokenService,
        private Client $client,
        private string $apiUrl,
        private string $token,
        private string $refreshAccessToken,
    ) {}

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'JWT ' . $this->getAccessToken()->access_token,
            'Content-Type' => 'application/json',
        ];
    }

    public function getAccessToken(): AccessTokenEntity
    {
        return $this->getAccessTokenService->handle($this->token, $this->refreshAccessToken);
    }

    private function validateResponse(ResponseInterface $response): void {
        if ($response->getStatusCode() !== Response::HTTP_OK && $response->getStatusCode() !== Response::HTTP_CREATED) {
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
            'planned_datetime' => $createOrderDto->orderPlannedAt,
            'points' => $createOrderDto->points,
        ];

        $preparedData = $this->removeNullValues($formParams);

        try {
            $response = $this->client->request('POST', $this->apiUrl . self::CREATE_ORDER, [
                RequestOptions::JSON => $preparedData,
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
                status: OrderGroupStatusEnum::tryFrom((string) $responseBodyArr['group_detail']['state']),
            );
        } catch (Throwable $e) {
            Log::critical('Request params', $formParams);
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }

    public function cancelOrder(int $orderId): void
    {
        try {
            $response = $this->client->request('POST', $this->apiUrl . self::CANCEL_ORDER . '/' . $orderId, [
                'headers' => $this->getHeaders()
            ]);
        } catch (GuzzleException $e) {
            Log::critical('Request params', [$orderId]);
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
        try {
            $this->validateResponse($response);
        } catch (UnexpectedErrorException $e) {
            Log::critical('Request params', [$orderId]);
            throw  $e;
        }

        try {
            $responseBody = $response->getBody()->getContents();
            $responseBodyArr = json_decode($responseBody, true);

            if (isset($responseBodyArr['detail']) && $responseBodyArr['detail'] !== 'Ok') {
                throw new UnexpectedErrorException($responseBodyArr['detail']);
            }
        } catch (Throwable $e) {
            Log::critical('Request params', $formParams);
            throw new UnexpectedErrorException($e->getMessage(), 0, $e);
        }
    }

    private function removeNullValues(array $array): array
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = $this->removeNullValues($value);

                if (empty($value)) {
                    unset($array[$key]);
                }
            } elseif ($value === null) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
