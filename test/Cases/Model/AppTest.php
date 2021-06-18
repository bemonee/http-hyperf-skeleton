<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    private const A_APP_ID = 1;
    private const A_APP_NAME = 'test-app';

    private const A_ROLE = [
        'id' => 1,
        'name' => 'admin',
    ];

    private const ANOTHER_ROLE = [
        'id' => 2,
        'name' => 'user',
    ];

    private const A_TENANT = [
        'id' => 1,
        'name' => 'Hergo',
    ];

    public function testAppCreation(): void
    {
        $aRole = (new Role())
            ->setId(self::A_ROLE['id'])
            ->setName(self::A_ROLE['name']);

        $anotherRole = (new Role())
            ->setId(self::ANOTHER_ROLE['id'])
            ->setName(self::ANOTHER_ROLE['name']);

        $aTenant = (new Tenant())
            ->setId(self::A_TENANT['id'])
            ->setName(self::A_TENANT['name']);

        $app = (new App())
            ->setId(self::A_APP_ID)
            ->setName(self::A_APP_NAME)
            ->addRole($aRole)
            ->addRole($anotherRole)
            ->addTenant($aTenant);

        $this->assertEquals($app->getId(), self::A_APP_ID);
        $this->assertEquals($app->getName(), self::A_APP_NAME);

        $aFoundRole = $app->roles()->find(self::A_ROLE['id']);
        $this->assertEquals($aRole->getId(), $aFoundRole->id);
        $this->assertEquals($aRole->getName(), $aFoundRole->name);

        $anotherFoundRole = $app->roles()->find(self::ANOTHER_ROLE['id']);
        $this->assertEquals($anotherRole->getId(), $anotherFoundRole->id);
        $this->assertEquals($anotherRole->getName(), $anotherFoundRole->name);

        $aTenant = $app->tenants()->find(self::A_TENANT['id']);
        $this->assertEquals($aTenant->getId(), self::A_TENANT['id']);
        $this->assertEquals($aTenant->getName(), self::A_TENANT['name']);
    }
}
