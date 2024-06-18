<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CancelOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orders' => 'required',
            'orders.*.id' => 'required|integer',
            'delivery_service_name' => 'required',
        ];
    }
}
