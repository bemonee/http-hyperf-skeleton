<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

final class TenantTest extends TestCase
{
    private const A_TENANT = [
        'id' => 1,
        'name' => 'a-tenant',
        'segment' => [
            'id' => 1,
            'name' => 'Fintech'
        ],
        'apps' => [
            ['id' => '1', 'name' => 'an-app'],
            ['id' => '2', 'name' => 'another-app'],
        ],
    ];

    public function testTenantCreation(): void
    {
        $aSegment = (new Segment())
            ->setId(self::A_TENANT['segment']['id'])
            ->setName(self::A_TENANT['segment']['name']);

        $anApp = (new App())
            ->setId(self::A_TENANT['apps'][0]['id'])
            ->setName(self::A_TENANT['apps'][0]['name']);

        $anotherApp = (new App())
            ->setId(self::A_TENANT['apps'][1]['id'])
            ->setName(self::A_TENANT['apps'][1]['name']);

        $tenant = (new Tenant())
            ->setId(self::A_TENANT['id'])
            ->setName(self::A_TENANT['name'])
            ->setSegment($aSegment)
            ->addApp($anApp)
            ->addApp($anotherApp);

        $this->assertEquals($tenant->getId(), self::A_TENANT['id']);
        $this->assertEquals($tenant->getName(), self::A_TENANT['name']);

        $this->assertEquals($tenant->getSegment()->getId(), self::A_TENANT['segment']['id']);
        $this->assertEquals($tenant->getSegment()->getName(), self::A_TENANT['segment']['name']);

        $aFoundApp = $tenant->getApps()->first();
        $this->assertEquals($anApp->getId(), $aFoundApp->getId());
        $this->assertEquals($anApp->getName(), $aFoundApp->getName());

        $anotherFoundApp = $tenant->getApps()->last();
        $this->assertEquals($anotherApp->getId(), $anotherFoundApp->getId());
        $this->assertEquals($anotherApp->getName(), $anotherFoundApp->getName());
    }
}
