<?php

declare(strict_types=1);

namespace SmartDelivery\HttpClients\Raketa\Services\Impl;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use SmartDelivery\HttpClients\Raketa\DTO\AccessTokenDto;
use SmartDelivery\HttpClients\Raketa\Entities\UnexpectedErrorException;
use SmartDelivery\HttpClients\Raketa\RaketaAuthHttpClientInterface;
use SmartDelivery\HttpClients\Raketa\Responses\GetAccessTokenResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final readonly class RaketaAuthHttpClientInterfaceImpl implements RaketaAuthHttpClientInterface
{
    private const GET_ACCESS_TOKEN = '/api-gate/v0/common/api-token-refresh';

    public function __construct(
        private Client $client,
        private string $apiUrl,
    ) {}

    public function obtainAccessToken(AccessTokenDto $accessTokenDto): GetAccessTokenResponse
    {
        $formParams = [
            'refresh' => $accessTokenDto->refresh_token,
        ];

        try {
            $response = $this->client->request('POST', $this->apiUrl . self::GET_ACCESS_TOKEN, [
                RequestOptions::JSON => $formParams,
                'headers' => [
                    'Authorization' => 'JWT ' . $accessTokenDto->access_token,
                    'Content-Type' => 'application/json',
                ]
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

    private function validateResponse(ResponseInterface $response): void {
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new UnexpectedErrorException(
                $response->getBody()->getContents(),
                $response->getStatusCode()
            );
        }
    }
}
