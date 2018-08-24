<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\DefaultRole;
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

    public function testSourceAccessor()
    {
        $attribution = new Attribution();

        $user = new User();
        $clonedUser = clone $user;

        $attribution->setSource($user);

        $this->assertEquals($clonedUser, $attribution->getSource());
        $this->assertAttributeEquals($attribution->getSource(), 'source', $attribution);
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

        $attribution->setTarget(new Application());

        $this->assertEquals(new Application(), $attribution->getTarget());
        $this->assertAttributeEquals($attribution->getTarget(), 'target', $attribution);
    }

    public function testToArrayEmpty()
    {
        $attribution = new Attribution();

        $this->assertEquals(
            [
                'id'        => null,
                'role'      => null,
                'target'    => null,
                'source'    => null
            ],
            $attribution->toArray()
        );
    }

    public function testToArray()
    {
        $attribution = (new Attribution())
            ->setSource(new User())
            ->setTarget(new Application())
            ->setRole(new Role())
        ;

        $this->assertEquals(
            [
                'id'        => null,
                'role'      => $attribution->getRole()->toArray(),
                'target'    => $attribution->getTarget()->toArray(),
                'source'    => $attribution->getSource()->toArray()
            ],
            $attribution->toArray()
        );
    }

    public function testHydrateEmpty()
    {
        $attribution = new Attribution([]);

        $this->assertNull($attribution->getId());
        $this->assertNull($attribution->getSource());
        $this->assertNull($attribution->getTarget());
        $this->assertNull($attribution->getRole());
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
            $attribution->getTarget()
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
                ->setCreatedAt(new \DateTime('2016-11-18T17:01:06+01:00'))
                ->setAttributions(new ArrayCollection([$attribution])),
            $attribution->getSource()
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
