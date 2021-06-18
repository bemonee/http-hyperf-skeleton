<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

final class RolesTest extends TestCase
{
    private const A_ROLE_ID = 1;
    private const A_ROLE_NAME = 'admin';

    private const A_APP = [
        'id' => 1,
        'name' => 'test-app',
    ];

    public function testRoleCreation(): void
    {
        $anApp = (new App())
            ->setId(self::A_APP['id'])
            ->setName(self::A_ROLE_NAME['name']);

        $role = (new Role())
            ->setId(self::A_ROLE_ID)
            ->setName(self::A_ROLE_NAME)
            ->setApp($anApp);

        $this->assertEquals($role->getId(), self::A_ROLE_ID);
        $this->assertEquals($role->getName(), self::A_ROLE_NAME);

        $this->assertEquals($role->getApp()->getId(), self::A_APP['id']);
        $this->assertEquals($role->getApp()->getName(), self::A_APP['name']);
    }
}
