<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required',
            'merchant_name' => 'required',
            'all_style_order_id' => 'required',
            'sender_phone' => 'required',
            'recipient_phone' => 'required',
            'delivery_address' => 'required',
            'delivery_service_name' => 'required',
            'created_at' => 'required',
            'total_amount' => 'required',
            'items' => 'required|array',
            'planned_at' => 'nullable',
        ];
    }
}
