<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Translator;

use Illuminate\Contracts\Translation\Translator;

final class LaravelTranslator implements TranslatorInterface
{
    private Translator $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function get(string $key, array $replace = [], string $locale = null)
    {
        return $this->translator->get($key, $replace, $locale);
    }
}
