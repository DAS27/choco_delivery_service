<?php

return [
    App\Providers\AppServiceProvider::class,

    //Core
    \SmartDelivery\Core\JobDispatcher\Providers\JobDispatcherServiceProvider::class,
    \SmartDelivery\Core\EventDispatcher\Providers\EventDispatcherServiceProvider::class,

    //Modules
    \SmartDelivery\HttpClients\Raketa\Providers\RaketaHttpServiceProvider::class,
    \SmartDelivery\DeliveryService\Raketa\Providers\RaketaServiceProvider::class,
    \SmartDelivery\DeliveryService\Main\Providers\DeliveryServiceMainServiceProvider::class,
    \SmartDelivery\Order\Providers\OrderServiceProvider::class,
];

