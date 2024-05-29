<?php

declare(strict_types=1);

namespace SmartDelivery\Core\Database;

use Closure;
use Illuminate\Database\ConnectionInterface;
use SmartDelivery\Core\Database\Contracts\TransactionInterface;
use Throwable;

class IlluminateTransaction implements TransactionInterface
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function begin(): TransactionInterface
    {
        $this->connection->beginTransaction();

        return $this;
    }

    public function commit(): TransactionInterface
    {
        $this->connection->commit();

        return $this;
    }

    public function rollback(): TransactionInterface
    {
        $this->connection->rollBack();

        return $this;
    }

    /**
     * @param Closure $callback
     * @param int $attempts
     *
     * @return mixed
     * @throws Throwable
     */
    public function transaction(Closure $callback, $attempts = 1): mixed
    {
        return $this->connection->transaction(
            $callback,
            $attempts
        );
    }

    public function __destruct()
    {
        $this->rollback();
    }
}
