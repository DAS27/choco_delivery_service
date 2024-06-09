<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Models;

/**
 * @property string $id
 */
class AbstractStringableModel extends AbstractModel
{
    /**
     * Признак нужно ли использовать автоинкремент для ID.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Тип первичного ключа.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Возвращает идентификатор.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->getKey();
    }
}

