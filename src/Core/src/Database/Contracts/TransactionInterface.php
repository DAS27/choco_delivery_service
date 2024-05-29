<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Database\Contracts;

use Closure;

interface TransactionInterface
{
    /**
     * Начинает транзакцию.
     *
     * @return TransactionInterface
     */
    public function begin(): TransactionInterface;

    /**
     * Подтверждает транзакцию.
     *
     * @return TransactionInterface
     */
    public function commit(): TransactionInterface;

    /**
     * Откатывает транзакцию.
     *
     * @return TransactionInterface
     */
    public function rollback(): TransactionInterface;

    /**
     * Оборачивает в транзакцию выполнение пользовательского кода.
     *
     * @param Closure $callback
     * @param int $attempts
     *
     * @return mixed
     */
    public function transaction(Closure $callback, $attempts = 1): mixed;
}
