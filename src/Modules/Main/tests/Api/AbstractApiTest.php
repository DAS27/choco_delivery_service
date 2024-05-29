<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Tests\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use SmartDelivery\User\Database\Factories\UserFactory;
use SmartDelivery\User\Models\UserModel;

class AbstractApiTest extends TestCase
{
    use DatabaseTransactions;

    protected function createUserAndToken(): string
    {
        /** @var UserModel $user */
        $user = UserFactory::new()->create();
        return $user->createToken('Production token')->plainTextToken;
    }
}
