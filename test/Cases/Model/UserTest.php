<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private const A_TENANT_ID = 1;

    private const AN_APP_ID = 1;
    private const ANOTHER_APP_ID = 2;

    private const A_ROLE_ID = 1;
    private const ANOTHER_ROLE_ID = 2;

    private const A_USER = [
        'id' => 1,
        'email' => 'bemonee@gmail.com',
        'surname' => 'Ramiro Agustín',
        'lastname' => 'Pereyra Noreiko',
        'password' => 'aSecurePassword123.',
    ];

    public function testUserCreation(): void
    {
        $aTenant = (new Tenant())
            ->setId(self::A_TENANT_ID);

        $aUser = (new User())
            ->setId(self::A_USER['id'])
            ->setEmail(self::A_USER['email'])
            ->setSurname(self::A_USER['surname'])
            ->setLastname(self::A_USER['lastname'])
            ->setPassword(self::A_USER['password'])
            ->setTenant($aTenant);

        $anApp = (new App())
            ->setId(self::AN_APP_ID);

        $aRole = (new Role())
            ->setId(self::A_ROLE_ID);

        $aPermission = (new Permission())
            ->setUser($aUser)
            ->setApp($anApp)
            ->setRole($aRole);

        $aUser->addPermission($aPermission);

        $anotherApp = (new App())
            ->setId(self::ANOTHER_APP_ID);

        $anotherRole = (new Role())
            ->setId(self::ANOTHER_ROLE_ID);

        $anotherPermission = (new Permission())
            ->setUser($aUser)
            ->setApp($anotherApp)
            ->setRole($anotherRole);

        $aUser->addPermission($anotherPermission);

        $this->assertEquals($aUser->getId(), self::A_USER['id']);
        $this->assertEquals($aUser->getEmail(), self::A_USER['email']);
        $this->assertEquals($aUser->getSurname(), self::A_USER['surname']);
        $this->assertEquals($aUser->getLastname(), self::A_USER['lastname']);
        $this->assertEquals($aUser->getPassword(), self::A_USER['password']);
        $this->assertEquals($aUser->getTenant()->getId(), self::A_TENANT_ID);

        $aFoundPermission = $aUser->getPermissions()->first();
        $this->assertEquals($aUser->getId(), $aFoundPermission->getUser()->getId());
        $this->assertEquals($anApp->getId(), $aFoundPermission->getApp()->getId());
        $this->assertEquals($aRole->getId(), $aFoundPermission->getRole()->getId());

        $anotherFoundPermission = $aUser->getPermissions()->last();
        $this->assertEquals($aUser->getId(), $anotherFoundPermission->getUser()->getId());
        $this->assertEquals($anotherApp->getId(), $anotherFoundPermission->getApp()->getId());
        $this->assertEquals($anotherRole->getId(), $anotherFoundPermission->getRole()->getId());
    }
}
