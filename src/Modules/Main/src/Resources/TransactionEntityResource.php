<?php

namespace SmartDelivery\Main\Resources;

use SmartDelivery\Main\Utils\Money\MoneyFormatter;
use SmartDelivery\Transaction\Entities\TransactionEntity;

class TransactionEntityResource extends AbstractResource
{
    private TransactionEntity $transactionEntity;

    public function __construct(TransactionEntity $transactionEntity)
    {
        $this->transactionEntity = $transactionEntity;
    }

    public function toArray()
    {
        return [
            'id' => $this->transactionEntity->id,
            'type' => $this->transactionEntity->type->value,
            'datetime' => $this->transactionEntity->datetime->toDateTimeString(),
            'cardId' => $this->transactionEntity->cardId,
            'amount' => $this->transactionEntity->amount !== null ? MoneyFormatter::toDecimalString(
                $this->transactionEntity->amount
            ) : null,
            'amount_currency' => $this->transactionEntity->amount !== null ? MoneyFormatter::getCurrencySymbol(
                $this->transactionEntity->amount
            ) : '$',
            'merchant' => $this->transactionEntity->merchant,
            'refundedAmountUsd' => $this->transactionEntity->refundedAmountUsd,
            'customerFriendlyDescription' => $this->getDeclineReason(
                $this->transactionEntity->customerFriendlyDescription
            ),
        ];
    }

    private function getDeclineReason(?string $decline): ?string
    {
        if ($decline === null) {
            return null;
        }

        return trans()->has('transaction.' . $this->transactionEntity->customerFriendlyDescription) ?
            trans(
                'transaction.' . $this->transactionEntity->customerFriendlyDescription
            ) : $this->transactionEntity->customerFriendlyDescription;
    }
}
