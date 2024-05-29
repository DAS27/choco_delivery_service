<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Translator\Providers;

use Illuminate\Support\ServiceProvider;
use SmartDelivery\Core\Translator\LaravelTranslator;
use SmartDelivery\Core\Translator\TranslatorInterface;

final class TranslatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TranslatorInterface::class, LaravelTranslator::class);
    }

    public function provides(): array
    {
        return [
            TranslatorInterface::class,
        ];
    }
}
