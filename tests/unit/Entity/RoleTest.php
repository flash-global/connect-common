<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\Role;
use PHPUnit\Framework\TestCase;

/**
 * Class RoleTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class RoleTest extends TestCase
{
    public function testRoleAccessors()
    {
        $role = new Role();

        $role->setRole('test');

        $this->assertEquals('test', $role->getRole());
        $this->assertAttributeEquals($role->getRole(), 'role', $role);
    }

    public function testLabelAccessors()
    {
        $role = new Role();

        $role->setLabel('test');

        $this->assertEquals('test', $role->getLabel());
        $this->assertAttributeEquals($role->getLabel(), 'label', $role);
    }

    public function testUserCreatedAccessors()
    {
        $role = new Role();

        $role->setUserCreated(true);

        $this->assertEquals(true, $role->getUserCreated());
        $this->assertAttributeEquals($role->getUserCreated(), 'userCreated', $role);
    }

    /**
     * @dataProvider dataFetchLocalUsername
     */
    public function testFetchLocalUsername($role, $localUsername)
    {
        $this->assertEquals($localUsername, $role->fetchLocalUsername());
    }

    public function dataFetchLocalUsername()
    {
        return [
            0 => [
                (new Role())->setRole('Application:ADMIN:toto'),
                'toto'
            ],
            1 => [
                (new Role())->setRole('ADMIN'),
                null
            ],
            1 => [
                (new Role()),
                null
            ]
        ];
    }
}
