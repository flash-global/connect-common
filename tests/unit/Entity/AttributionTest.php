<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\ForeignServiceId;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributionTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class AttributionTest extends TestCase
{
    public function testIdAccessor()
    {
        $attribution = new Attribution();

        $attribution->setId(1);

        $this->assertEquals(1, $attribution->getId());
        $this->assertAttributeEquals($attribution->getId(), 'id', $attribution);
    }

    public function testUserAccessor()
    {
        $attribution = new Attribution();

        $attribution->setUser(new User());

        $this->assertEquals(new User(), $attribution->getUser());
        $this->assertAttributeEquals($attribution->getUser(), 'user', $attribution);
    }

    public function testRoleAccessor()
    {
        $attribution = new Attribution();

        $attribution->setRole(new Role());

        $this->assertEquals(new Role(), $attribution->getRole());
        $this->assertAttributeEquals($attribution->getRole(), 'role', $attribution);
    }

    public function testApplicationAccessor()
    {
        $attribution = new Attribution();

        $attribution->setApplication(new Application());

        $this->assertEquals(new Application(), $attribution->getApplication());
        $this->assertAttributeEquals($attribution->getApplication(), 'application', $attribution);
    }

    public function testIsDefaultAccessor()
    {
        $attribution = new Attribution();

        $attribution->setIsDefault(true);

        $this->assertEquals(true, $attribution->getIsDefault());
        $this->assertAttributeEquals($attribution->getIsDefault(), 'isDefault', $attribution);
    }

    public function testToArrayEmpty()
    {
        $attribution = new Attribution();

        $this->assertEquals(
            [
                'id'             => null,
                'role'           => null,
                'application'    => null,
                'user' => null,
                'is_default' => false
            ],
            $attribution->toArray()
        );
    }

    public function testToArray()
    {
        $attribution = (new Attribution())
            ->setId(1)
            ->setUser(
                (new User())
                    ->setId(1)
                    ->setUserName('user test')
                    ->setPassword('toto')
                    ->setFirstName('toto')
                    ->setLastName('toto')
                    ->setEmail('toto@toto.com')
                    ->setForeignServicesIds(
                        new ArrayCollection([
                            (new ForeignServiceId())
                                ->setName('google')
                                ->setId('id_google')
                        ])
                    )
            )
            ->setApplication(
                (new Application())
                    ->setId(1)
                    ->setName('application 1')
                    ->setLogoUrl('test')
            )
            ->setRole(
                (new Role())
                    ->setId(1)
                    ->setRole('role 1')
                    ->setLabel('role 1')
            )
            ;

        $attribution->getUser()->getAttributions()->add($attribution);

        $this->assertEquals(
            [
                'id' => 1,
                'application' => [
                    'id' => 1,
                    'name' => 'application 1',
                    'url' => null,
                    'status' => Application::STATUS_ENABLED,
                    'logo_url' => 'test',
                    'allow_profile_association' => false,
                    'is_subscribed' => false,
                    'is_manageable' => false,
                    'config' => '',
                    'contexts' => []
                ],
                'role' => [
                    'id' => 1,
                    'role' => 'role 1',
                    'label' => 'role 1',
                    'user_created' => false
                ],
                'user' => [
                    'id' => 1,
                    'user_name' => 'user test',
                    'first_name' => 'toto',
                    'last_name' => 'toto',
                    'email' => 'toto@toto.com',
                    'password' => 'toto',
                    'created_at' => $attribution->getUser()->getCreatedAt()->format(\DateTime::RFC3339),
                    'status' => User::STATUS_PENDING,
                    'register_token' => null,
                    'current_role' => null,
                    'local_username' => null,
                    'avatar_url' => null,
                    'mini_avatar_url' => null,
                    'language' => 'en',
                    'role_id' => null,
                    'foreign_services_ids' => [
                        [
                            'name' => 'google',
                            'id'   => 'id_google'
                        ]
                    ],
                    'attributions' => [
                        [
                            'id' => 1,
                            'application' => [
                                'id' => 1,
                                'name' => 'application 1',
                                'url' => null,
                                'status' => Application::STATUS_ENABLED,
                                'logo_url' => 'test',
                                'allow_profile_association' => false,
                                'is_subscribed' => false,
                                'is_manageable' => false,
                                'config' => '',
                                'contexts' => []
                            ],
                            'role' => [
                                'id' => 1,
                                'role' => 'role 1',
                                'label' => 'role 1',
                                'user_created' => false
                            ],
                            'is_default' => false
                        ]
                    ],
                    'current_attribution' => null
                ],
                'is_default' => false
            ],
            $attribution->toArray()
        );
    }

    public function testHydrateEmpty()
    {
        $attribution = new Attribution([]);

        $this->assertNull($attribution->getId());
        $this->assertNull($attribution->getUser());
        $this->assertNull($attribution->getApplication());
        $this->assertNull($attribution->getRole());
        $this->assertFalse($attribution->getIsDefault());
    }

    public function testHydrate()
    {
        $attribution = new Attribution([
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
        ]);

        $this->assertEquals(
            (new Application())
                ->setId(1)
                ->setName('application 1'),
            $attribution->getApplication()
        );

        $this->assertEquals(
            (new Role())
                ->setId(1)
                ->setRole('role 1')
                ->setLabel('role 1'),
            $attribution->getRole()
        );

        $this->assertEquals(
            (new User())
                ->setId(1)
                ->setUserName('user test')
                ->setPassword('toto')
                ->setAttributions(new ArrayCollection([$attribution])),
            $attribution->getUser()
        );

        $this->assertEquals(
            true,
            $attribution->getIsDefault()
        );
    }

    /**
     * @dataProvider dataFetchLocalUsername
     */
    public function testFetchLocalUsername($attribution, $localUsername)
    {
        $this->assertEquals($localUsername, $attribution->fetchLocalUsername());
    }

    public function dataFetchLocalUsername()
    {
        return [
            0 => [
                (new Attribution())
                    ->setRole(
                        (new Role())->setRole('Application:ADMIN:toto')
                    ),
                'toto'
            ],
            1 => [
                (new Attribution())
                    ->setRole(
                        (new Role())->setRole('ADMIN')
                    ),
                null
            ],
            2 => [
                (new Attribution())
                    ->setRole(
                        (new Role())
                    ),
                null
            ]
        ];
    }
}
