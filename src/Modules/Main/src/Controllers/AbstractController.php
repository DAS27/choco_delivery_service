<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Success response method.
     *
     * @param array|Arrayable|JsonSerializable $result
     * @param int                              $status
     * @param int                              $flags json_encode() $flags, such as JSON_FORCE_OBJECT
     *
     * @return JsonResponse
     */
    public function sendResponse(array|Arrayable|JsonSerializable $result, int $status = Response::HTTP_OK, int $flags = 0): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
        ];

        return response()->json($response, $status, [], $flags);
    }

    /**
     * Return error response.
     *
     * @param string $code
     * @param string $message
     * @param array  $errors
     * @param int    $status
     *
     * @return JsonResponse
     */
    public function sendError(string $code, string $message, array $errors = [], int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $response = [
            'success' => false,
            'code'    => $code,
            'message' => $message,
        ];

        if (! empty($errors)) {
            $response['data'] = $errors;
        }

        return response()->json($response, $status);
    }
}
