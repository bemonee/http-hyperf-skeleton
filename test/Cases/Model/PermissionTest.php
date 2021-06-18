<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    private const A_PERMISSION = [
        'userId' => 1,
        'appId' => 1,
        'roleId' => 1
    ];

    public function testPermissionCreation(): void
    {
        $aUser = (new User())
            ->setId(self::A_PERMISSION['userId']);

        $anApp = (new App())
            ->setId(self::A_PERMISSION['appId']);

        $aRole = (new Role())
            ->setId(self::A_PERMISSION['roleId']);

        $aPermission = (new Permission())
            ->setUser($aUser)
            ->setApp($anApp)
            ->setRole($aRole);

        $this->assertEquals(
            $aPermission->getUser()->getId(),
            self::A_PERMISSION['userId']
        );

        $this->assertEquals(
            $aPermission->getApp()->getId(),
            self::A_PERMISSION['appId']
        );

        $this->assertEquals(
            $aPermission->getRole()->getId(),
            self::A_PERMISSION['roleId']
        );
    }
}
