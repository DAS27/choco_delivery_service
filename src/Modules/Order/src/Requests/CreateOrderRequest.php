<?php

declare(strict_types=1);

namespace SmartDelivery\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Дополнительная проверка прав доступа, если необходимо
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|integer',
            'merchant_name' => 'required|string|max:255',
            'all_style_order_id' => 'required|integer',
            'sender_phone' => 'required|string|regex:/^\+?[0-9]{11,15}$/',
            'recipient_phone' => 'required|string|regex:/^\+?[0-9]{11,15}$/',
            'delivery_address' => 'required|array',
            'delivery_address.street' => 'required|string|max:255',
            'delivery_address.building' => 'required|string|max:255',
            'delivery_address.extra_info' => 'nullable|string|max:255',
            'delivery_service_name' => 'required|string|max:255',
            'created_at' => 'required|date_format:Y-m-d\TH:i',
            'total_amount' => 'required|string|max:20',
            'items' => 'required|array',
            'items.*.title' => 'required|string|max:255',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.count' => 'required|integer|min:1',
            'items.*.address' => 'required|array',
            'items.*.address.street' => 'required|string|max:255',
            'items.*.address.building' => 'required|string|max:255',
            'items.*.address.flat' => 'nullable|string|max:255',
            'items.*.address.comment' => 'nullable|string|max:255',
            'items.*.warehouse_type' => 'required|string|max:255',
            'planned_at' => 'nullable|string|date_format:Y-m-d\TH:i',
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required.',
            'order_id.integer' => 'Order ID must be an integer.',
            'merchant_name.required' => 'Merchant name is required.',
            'merchant_name.string' => 'Merchant name must be a string.',
            'sender_phone.required' => 'Sender phone is required.',
            'sender_phone.regex' => 'Sender phone must be a valid phone number in the format +77078692233.',
            'recipient_phone.required' => 'Recipient phone is required.',
            'recipient_phone.regex' => 'Recipient phone must be a valid phone number in the format +77078692233.',
            'delivery_address.required' => 'Delivery address is required.',
            'delivery_address.street.required' => 'Street in delivery address is required.',
            'delivery_address.building.required' => 'Building in delivery address is required.',
            'delivery_service_name.required' => 'Delivery service name is required.',
            'created_at.required' => 'Created at is required.',
            'created_at.date_format' => 'Created at must be in the format YYYY-MM-DDThh:mm.',
            'total_amount.required' => 'Total amount is required.',
            'items.required' => 'Items are required.',
            'items.*.title.required' => 'Each item must have a title.',
            'items.*.price.required' => 'Each item must have a price.',
            'items.*.price.numeric' => 'Each item price must be a number.',
            'items.*.price.min' => 'Each item price must be at least 0.',
            'items.*.count.required' => 'Each item must have a count.',
            'items.*.count.integer' => 'Each item count must be an integer.',
            'items.*.count.min' => 'Each item count must be at least 1.',
            'items.*.address.required' => 'Each item must have an address.',
            'items.*.address.street.required' => 'Each item address must have a street.',
            'items.*.address.building.required' => 'Each item address must have a building.',
            'items.*.address.flat.nullable' => 'Each item address flat can be null.',
            'items.*.address.comment.nullable' => 'Each item address comment can be null.',
            'items.*.warehouse_type.required' => 'Each item must have a warehouse type.',
            'planned_at.date_format' => 'Planned at must be in the format YYYY-MM-DDThh:mm.',
        ];
    }
}
