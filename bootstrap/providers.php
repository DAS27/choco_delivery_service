<?php

return [
    App\Providers\AppServiceProvider::class,

    //Core
    \SmartDelivery\Core\JobDispatcher\Providers\JobDispatcherServiceProvider::class,
    \SmartDelivery\Core\EventDispatcher\Providers\EventDispatcherServiceProvider::class,

    //Modules
//    \SmartDelivery\HttpClients\ChocoDostavka\Providers\ChocoDostavkaHttpServiceProvider::class,
    \SmartDelivery\DeliveryIntegration\ChocoDostavka\Providers\ChocoDostavkaServiceProvider::class,
    \SmartDelivery\DeliveryIntegration\SmartDeal\Providers\SmartDealServiceProvider::class
];

