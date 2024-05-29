<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Resources;

use Illuminate\Support\Facades\Storage;
use Money\Money;
use SmartDelivery\Card\Enums\CardProviderEnum;
use SmartDelivery\Card\Models\CardModel;
use SmartDelivery\Main\Utils\Money\MoneyFormatter;
use SmartDelivery\Card\Entities\CardEntity;

final class PrepaidCardResource extends AbstractResource
{
    private CardModel $card;

    public function __construct(CardModel $card)
    {
        $this->card = $card;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->card->id,
            'value' => MoneyFormatter::toDecimalString(Money::USD($this->card->value)),
            'mask' => $this->card->mask,
            'payment_network' => $this->card->payment_network,
            'type' => $this->card->type,
            'expired' => $this->card->expired,
            'user_id' => $this->card->user_id,
            'skin' => $this->card->skin,
            'card_product' => [
                'skin_url' => Storage::disk('r2')->url($this->card->cardProduct->skin_url),
                'skin_preview_url' => Storage::disk('r2')->url($this->card->cardProduct->skin_preview_url),
                'name' => $this->card->cardProduct->name,
            ]
        ];
    }
}
