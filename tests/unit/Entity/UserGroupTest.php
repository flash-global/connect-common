<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\EntitySet;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Entity\UserGroup;
use PHPUnit\Framework\TestCase;

/**
 * Class UserGroupTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class UserGroupTest extends TestCase
{
    public function testNameAccessors()
    {
        $group = new UserGroup();

        $group->setName('test');

        $this->assertEquals('test', $group->getName());
        $this->assertAttributeEquals($group->getName(), 'name', $group);
    }

    public function testApplicationGroups()
    {
        $group = (new UserGroup());
        $user  = (new User())->setId(23);

        $group->addUsers($user);

        $this->assertEquals(23, $group->getUsers()->toArray()[0]->getId());

        $group->removeUsers($user);

        $this->assertEmpty($group->getUsers()->toArray());
    }

    public function testDefaultRoleAccessors()
    {
        $role = (new Role())->setId(23);

        $group = new UserGroup();
        $group->setDefaultRole($role);

        $this->assertEquals($role, $group->getDefaultRole());
    }

    public function testAttributionsAccessors()
    {
        $group = new UserGroup();
        $attribution = (new Attribution())
            ->setSource($group)
            ->setTarget(new Application())
            ->setRole(new Role())
        ;

        $coll = new ArrayCollection();
        $coll->add($attribution);

        $group->setAttributions($coll);


        $this->assertEquals($coll, $group->getAttributions());
    }


    public function testToArray()
    {
        $userGroup = (new UserGroup());
        $attribution = (new Attribution())
            ->setSource($userGroup)
            ->setRole((new Role())->setId(23))
            ->setTarget((new Application()));

        $attribution2 = (new Attribution())
            ->setSource($userGroup)
            ->setRole((new Role())->setId(23))
            ->setTarget((new ApplicationGroup()));

        $user = (new User());


        $attributions = new ArrayCollection();
        $attributions->add($attribution);
        $attributions->add($attribution2);

        $users = new ArrayCollection();
        $users->add($user);

        $userGroup->setAttributions($attributions);
        $userGroup->setUsers($users);

        $array = $userGroup->toArray();

        $this->assertNotEmpty($array['users']);
        $this->assertNotEmpty($array['applications']);
        $this->assertNotEmpty($array['applicationGroups']);
    }
}
