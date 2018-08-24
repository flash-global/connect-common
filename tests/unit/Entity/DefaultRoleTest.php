<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\DefaultRole;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class DefaultRoleTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class DefaultRoleTest extends TestCase
{
    public function testAccessors()
    {
        $defaultRole = (new DefaultRole())
            ->setRole((new Role())->setId(21))
            ->setApplication((new Application())->setId(22))
            ->setUser((new User())->setId(23))
        ;

        $this->assertEquals(21, $defaultRole->getRole()->getId());
        $this->assertEquals(22, $defaultRole->getApplication()->getId());
        $this->assertEquals(23, $defaultRole->getUser()->getId());
    }
}
