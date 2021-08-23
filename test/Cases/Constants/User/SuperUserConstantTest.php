<?php

declare(strict_types=1);

namespace Test\Cases\Constants\User;

use PHPUnit\Framework\TestCase;
use App\Constants\User\SuperUserConstant;

final class SuperUserConstantTest extends TestCase
{
    private const SUPER_USER_ID = 1;

    private const SUPER_USER_NAME = 'Superuser';

    private const A_NON_SUPER_USER_ID = 2;

    public function testSuperUserConstant(): void
    {
        $this->assertEquals(self::SUPER_USER_ID, SuperUserConstant::getId());

        $this->assertEquals(self::SUPER_USER_NAME, SuperUserConstant::getName());

        $this->assertTrue(SuperUserConstant::isSuperUser(self::SUPER_USER_ID));

        $this->assertNotTrue(SuperUserConstant::isSuperUser(self::A_NON_SUPER_USER_ID));
    }
}
