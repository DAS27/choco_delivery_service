<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Resources;

use SmartDelivery\CardIntegration\Main\Contracts\Dto\CardTransactionDto;

final class TransactionResource extends AbstractResource
{
    private CardTransactionDto $transactionDto;

    public function __construct(CardTransactionDto $card)
    {
        $this->transactionDto = $card;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->transactionDto->type,
            'datetime' => $this->transactionDto->datetime->toDateTimeString(),
            'amount' => $this->transactionDto->amount?->getAmount(),
            'merchant' => $this->transactionDto->merchant,
            'refunded_amount_usd' => $this->transactionDto->refundedAmountUsd,
            'customer_friendly_description' => $this->transactionDto->customerFriendlyDescription,
        ];
    }
}
