<?php

declare(strict_types=1);

namespace SmartDelivery\DeliveryService\Main\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use SmartDelivery\Main\Models\AbstractStringableModel;
use SmartDelivery\Order\Models\OrderModel;

final class DeliveryServiceModel extends AbstractStringableModel
{
    protected $table = 'delivery_services';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrderModel::class);
    }
}
