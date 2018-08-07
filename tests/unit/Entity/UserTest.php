<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\ForeignServiceId;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Entity\UserGroup;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class UserTest extends TestCase
{
    public function testUserNameAccessors()
    {
        $user = new User();

        $user->setUserName('test');

        $this->assertEquals('test', $user->getUserName());
        $this->assertAttributeEquals($user->getUserName(), 'userName', $user);
    }

    public function testPasswordAccessors()
    {
        $user = new User();

        $user->setPassword('test');

        $this->assertEquals('test', $user->getPassword());
        $this->assertAttributeEquals($user->getPassword(), 'password', $user);
    }

    public function testFirstNameAccessors()
    {
        $user = new User();

        $user->setFirstName('test');

        $this->assertEquals('test', $user->getFirstName());
        $this->assertAttributeEquals($user->getFirstName(), 'firstName', $user);
    }

    public function testLastNameAccessors()
    {
        $user = new User();

        $user->setLastName('test');

        $this->assertEquals('test', $user->getLastName());
        $this->assertAttributeEquals($user->getLastName(), 'lastName', $user);
    }

    public function testEmailAccessors()
    {
        $user = new User();

        $user->setEmail('test');

        $this->assertEquals('test', $user->getEmail());
        $this->assertAttributeEquals($user->getEmail(), 'email', $user);
    }

    public function testRegisterTokenAccessors()
    {
        $user = new User();

        $user->setRegisterToken('test');

        $this->assertEquals('test', $user->getRegisterToken());
        $this->assertAttributeEquals($user->getRegisterToken(), 'registerToken', $user);
    }

    public function testCurrentRoleAccessors()
    {
        $user = new User();

        $user->setCurrentRole('test');

        $this->assertEquals('test', $user->getCurrentRole());
        $this->assertAttributeEquals($user->getCurrentRole(), 'currentRole', $user);
    }

    public function testAvatarUrlAccessors()
    {
        $user = new User();

        $user->setAvatarUrl('test');

        $this->assertEquals('test', $user->getAvatarUrl());
        $this->assertAttributeEquals($user->getAvatarUrl(), 'avatarUrl', $user);
    }

    public function testMiniAvatarUrlAccessors()
    {
        $user = new User();

        $user->setMiniAvatarUrl('test');

        $this->assertEquals('test', $user->getMiniAvatarUrl());
        $this->assertAttributeEquals($user->getMiniAvatarUrl(), 'miniAvatarUrl', $user);
    }

    public function testLocalUsernameAccessors()
    {
        $user = new User();

        $user->setLocalUsername('batman');

        $this->assertEquals('batman', $user->getLocalUsername());
        $this->assertAttributeEquals($user->getLocalUsername(), 'localUsername', $user);
    }

    public function testLanguageAccessors()
    {
        $user = new User();

        $user->setLanguage('test');

        $this->assertEquals('test', $user->getLanguage());
        $this->assertAttributeEquals($user->getLanguage(), 'language', $user);
    }

    public function testAttributionsAccessors()
    {
        $user = new User();

        $attributions = new ArrayCollection([
            new Attribution([
                'application' => [
                    'id' => 1,
                    'name' => 'application 1'
                ],
                'role' => [
                    'id' => 1,
                    'role' => 'role 1',
                    'label' => 'role 1'
                ],
                'user' => [
                    'id' => 1,
                    'user_name' => 'user test',
                    'password' => 'toto',
                    'created_at' => '2016-11-18T17:01:06+01:00',
                    'status' => User::STATUS_PENDING,
                    'register_token' => null,
                ],
                'is_default' => true
            ]),
            new Attribution([
                'application' => [
                    'id' => 1,
                    'name' => 'application 1'
                ],
                'role' => [
                    'id' => 2,
                    'role' => 'role 2',
                    'label' => 'role 2'
                ],
                'user' => [
                    'id' => 1,
                    'user_name' => 'user test',
                    'password' => 'toto',
                    'created_at' => '2016-11-18T17:01:06+01:00',
                    'status' => User::STATUS_PENDING,
                    'register_token' => null,
                ],
                'is_default' => false
            ])
        ]);

        $user->setAttributions($attributions);

        $this->assertEquals($attributions, $user->getAttributions());
        $this->assertAttributeEquals($user->getAttributions(), 'attributions', $user);
    }

    public function testForeignServicesIdsAccessors()
    {
        $user = new User();

        $user->setForeignServicesIds(
            new ArrayCollection([
                (new ForeignServiceId())
                    ->setName('google')
                    ->setId('id_google')
            ])
        );

        $this->assertEquals(
            new ArrayCollection([
                    (new ForeignServiceId())
                        ->setName('google')
                        ->setId('id_google')
            ]),
            $user->getForeignServicesIds()
        );

        $user->addForeignServiceId(
            (new ForeignServiceId())
                ->setName('linkedin')
                ->setId('id_linkedin')
        );

        $this->assertEquals(
            new ArrayCollection([
                    (new ForeignServiceId())
                        ->setName('google')
                        ->setId('id_google'),
                    (new ForeignServiceId())
                        ->setName('linkedin')
                        ->setId('id_linkedin')
            ]),
            $user->getForeignServicesIds()
        );

        $user->removeForeignServiceId('linkedin');

        $this->assertEquals(
            new ArrayCollection([
                    (new ForeignServiceId())
                        ->setName('google')
                        ->setId('id_google')
            ]),
            $user->getForeignServicesIds()
        );
    }


    public function testAttributionAccessors()
    {
        $user = new User();

        $user->setAttributions(
            new ArrayCollection([
                (new Attribution())
                    ->setSource($user)
                    ->setTarget(
                        (new Application())
                            ->setName('application test 1')
                    )
                    ->setRole(
                        (new Role())
                            ->setRole('role test 1')
                    )
            ])
        );

        $this->assertEquals(
            new ArrayCollection([
                (new Attribution())
                    ->setSource($user)
                    ->setTarget(
                        (new Application())
                            ->setName('application test 1')
                    )
                    ->setRole(
                        (new Role())
                            ->setRole('role test 1')
                    )
            ]),
            $user->getAttributions()
        );
        $this->assertAttributeEquals($user->getAttributions(), 'attributions', $user);

        $user->setAttributions(
            new ArrayCollection([
                (new Attribution())
                    ->setSource($user)
                    ->setTarget(
                        (new Application())
                            ->setName('application test 2')
                    )
                    ->setRole(
                        (new Role())
                            ->setRole('role test 2')
                    )
            ])
        );

        $this->assertEquals(
            new ArrayCollection([
                (new Attribution())
                    ->setSource($user)
                    ->setTarget(
                        (new Application())
                            ->setName('application test 2')
                    )
                    ->setRole(
                        (new Role())
                            ->setRole('role test 2')
                    )
            ]),
            $user->getAttributions()
        );
    }

    public function testToArrayEmpty()
    {
        $user = new User();

        $this->assertEquals(
            [
                'id' => null,
                'user_name' => null,
                'first_name' => null,
                'last_name' => null,
                'email' => null,
                'password' => null,
                'created_at' => $user->getCreatedAt()->format(\DateTime::RFC3339),
                'status' => User::STATUS_PENDING,
                'register_token' => null,
                'current_role' => null,
                'local_username' => null,
                'attributions' => [],
                'current_attribution' => null,
                'avatar_url' => null,
                'mini_avatar_url' => null,
                'language' => 'en',
                'role_id' => null,
                'foreign_services_ids' => [],
                'user_groups' => [],
                'applications' => [],
                'applicationGroups' => []
            ],
            $user->toArray()
        );
    }

    public function testToArray()
    {
        $user = new User();

        $currentAttribution = (new Attribution())
            ->setId(1)
            ->setSource($user)
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
            );

        $userGroups = new ArrayCollection();
        $userGroups->add((new UserGroup())->setId(25));

        $user
            ->setForeignServicesIds(
                new ArrayCollection([
                    (new ForeignServiceId())
                        ->setName('google')
                        ->setId('toto123'),
                    (new ForeignServiceId())
                        ->setName('linkedin')
                        ->setId('456')
                ])
            )
            ->setUserGroups($userGroups)
            ->setAttributions(
                new ArrayCollection([
                    $currentAttribution,
                    (new Attribution())
                        ->setId(2)
                        ->setSource($user)
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
                ])
            )
            ->setCurrentAttribution($currentAttribution);

        $this->assertEquals(
            [
                'id' => null,
                'user_name' => null,
                'password' => null,
                'first_name' => null,
                'last_name' => null,
                'email' => null,
                'created_at' => $user->getCreatedAt()->format(\DateTime::RFC3339),
                'status' => User::STATUS_PENDING,
                'register_token' => null,
                'current_role' => null,
                'local_username' => null,
                'avatar_url' => null,
                'mini_avatar_url' => null,
                'language' => 'en',
                'role_id' => null,
                'user_groups' => [
                    0 => [
                        'id' => 25,
                        'name' => null,
                        'default_role' => null
                    ]
                ],
                'foreign_services_ids' => [
                    [
                        'name' => 'google',
                        'id' => 'toto123'
                    ],
                    [
                        'name' => 'linkedin',
                        'id' => '456'
                    ]
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
                ],
                'applications' => [
                    [
                        'id' => 1,
                        'name' => 'application test 1',
                        'url' => null,
                        'status' => Application::STATUS_ENABLED,
                        'logo_url' => 'test1',
                        'allow_profile_association' => false,
                        'is_subscribed' => false,
                        'is_manageable' => false,
                        'config' => '',
                        'contexts' => [],
                        'idrole' => 1
                    ]
                ],
                'applicationGroups' => [
                    [
                        'id' => 2,
                        'name' => 'application group test',
                        'idrole' => 2
                    ]
                ],
                'current_attribution' => [
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
                        'user_created' => false,
                    ]
                ],
            ],
            $user->toArray()
        );
    }

    public function testHydrateRolesEmpty()
    {
        $user = new User([
            'attributions' => []
        ]);

        $this->assertEmpty($user->getAttributions()->toArray());
    }

    public function testHydrateForeignServicesIdsEmpty()
    {
        $user = new User([
            'foreign_services_ids' => []
        ]);

        $this->assertEmpty($user->getForeignServicesIds()->toArray());
    }

    public function testHydrate()
    {
        $date = (new \DateTime('2018-12-12'))->format(\DateTime::RFC3339);

        $user = new User([
            'created_at' => $date,
            'foreign_services_ids' => [
                [
                    'name' => 'google',
                    'id' => 'toto123'
                ],
                [
                    'name' => 'linkedin',
                    'id' => 'toto456'
                ]
            ],
            'attributions' => [
                [
                    'id' => 1,
                    'application' => [
                        'id' => 1,
                        'name' => 'application test 1'
                    ],
                    'role' => [
                        'id' => 1,
                        'role' => 'role test 1'
                    ]
                ],
                [
                    'id' => 2,
                    'application' => [
                        'id' => 2,
                        'name' => 'application test 2'
                    ],
                    'role' => [
                        'id' => 2,
                        'role' => 'role test 2'
                    ]
                ],
                [
                    'id' => 3,
                    'application_group' => [
                        'id' => 1,
                        'name' => 'application group test 2'
                    ],
                    'role' => [
                        'id' => 3,
                        'role' => 'role test 3'
                    ]
                ]
            ],
            'current_attribution' => [
                'id' => 1,
                'application' => [
                    'id' => 1,
                    'name' => 'application test 1'
                ],
                'role' => [
                    'id' => 1,
                    'role' => 'role test 1'
                ]
            ]
        ]);

        $currentAttribution = (new Attribution())
            ->setId(1)
            ->setSource($user)
            ->setRole(
                (new Role())
                    ->setId(1)
                    ->setRole('role test 1')
            )
            ->setTarget(
                (new Application())
                    ->setId(1)
                    ->setName('application test 1')
            );

        $this->assertEquals(
            new ArrayCollection([
                $currentAttribution,
                (new Attribution())
                    ->setId(2)
                    ->setSource($user)
                    ->setRole(
                        (new Role())
                            ->setId(2)
                            ->setRole('role test 2')
                    )
                    ->setTarget(
                        (new Application())
                            ->setId(2)
                            ->setName('application test 2')
                    ),
                (new Attribution())
                    ->setId(3)
                    ->setSource($user)
                    ->setRole(
                        (new Role())
                            ->setId(3)
                            ->setRole('role test 3')
                    )
                    ->setTarget(
                        (new ApplicationGroup())
                            ->setId(1)
                            ->setName('application group test 2')
                    )
            ]),
            $user->getAttributions()
        );

        $this->assertEquals(
            new ArrayCollection([
                    (new ForeignServiceId())
                        ->setName('google')
                        ->setId('toto123'),
                    (new ForeignServiceId())
                        ->setName('linkedin')
                        ->setId('toto456')
            ]),
            $user->getForeignServicesIds()
        );

        $this->assertEquals(
            new \DateTime($date),
            $user->getCreatedAt()
        );

        $this->assertEquals(
            $currentAttribution,
            $user->getCurrentAttribution()
        );
    }

    public function testUserGroups()
    {
        $user      = (new User());
        $userGroup = (new UserGroup())->setId(23);

        $user->addUserGroups($userGroup);

        $this->assertEquals(23, $user->getUserGroups()->toArray()[0]->getId());

        $user->removeUserGroups($userGroup);

        $this->assertEmpty($user->getUserGroups()->toArray());
    }
}
