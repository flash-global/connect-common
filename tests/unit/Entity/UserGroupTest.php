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
    }

    public function testHydrate()
    {
        $data = [
            'id' => 1,
            'name' => 'Group 1',
            'default_role' => [
                'id' => 1,
                'role' => 'USER'
            ],
            'attributions' => [
                [
                    'id' => 1,
                    'application' => [
                        'id' => 1,
                        'name' => 'application test 1',
                        'url' => null,
                        'status' => Application::STATUS_ENABLED,
                        'logo_url' => 'test1',
                        'allow_profile_association' => false,
                        'is_subscribed' => false,
                        'is_manageable' => false,
                        'config' => '',
                        'contexts' => []
                    ],
                    'role' => [
                        'id' => 1,
                        'role' => 'role test 1',
                        'label' => 'role test 1',
                        'user_created' => false
                    ]
                ],
                [
                    'id' => 2,
                    'application_group' => [
                        'id' => 2,
                        'name' => 'application group test',
                    ],
                    'role' => [
                        'id' => 2,
                        'role' => 'role test 2',
                        'label' => 'role test 2',
                        'user_created' => false,
                    ]
                ]
            ]
        ];

        $usersGroup = (new UserGroup())
            ->setId(1)
            ->setName('Group 1')
            ->setDefaultRole(
                (new Role())
                    ->setId(1)
                    ->setRole('USER')
            );

        $attributions = new ArrayCollection([
            (new Attribution())
                ->setId(1)
                ->setSource($usersGroup)
                ->setTarget(
                    (new Application())
                        ->setId(1)
                        ->setName('application test 1')
                        ->setLogoUrl('test1')
                )
                ->setRole(
                    (new Role())
                        ->setId(1)
                        ->setRole('role test 1')
                        ->setLabel('role test 1')
                ),
            (new Attribution())
                ->setId(2)
                ->setSource($usersGroup)
                ->setTarget(
                    (new ApplicationGroup())
                        ->setId(2)
                        ->setName('application group test')
                )
                ->setRole(
                    (new Role())
                        ->setId(2)
                        ->setRole('role test 2')
                        ->setLabel('role test 2')
                )
        ]);

        $usersGroup->setAttributions($attributions);

        $this->assertEquals($usersGroup, new UserGroup($data));
    }
}
