<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Tests\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class AbstractApiTest extends TestCase
{
    use DatabaseTransactions;

    protected function createUserAndToken(): string
    {
    }
}
