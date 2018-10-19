<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ProfileAssociation;
use Fei\Service\Connect\Common\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationTest
 * @package Test\Fei\Service\Connect\Common\Entity
 */
class ProfileAssociationTest extends TestCase
{
    /**
     * @var ProfileAssociation $profileAssociation
     */
    protected $profileAssociation;

    /**
     * @var string $profile
     */
    protected $profile;

    /**
     * @var string $role
     */
    protected $role;

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var Application $application
     */
    protected $application;

    public function setUp()
    {
        $this->profileAssociation = new ProfileAssociation();

        $this->profile = "BGM44";
        $this->role = "USER";
        $this->user = new User();
        $this->application = new Application();
    }

    public function testIfClassHasAttributes()
    {
        $this->assertClassHasAttribute('id', ProfileAssociation::class);
        $this->assertClassHasAttribute('profile', ProfileAssociation::class);
        $this->assertClassHasAttribute('role', ProfileAssociation::class);
        $this->assertClassHasAttribute('user', ProfileAssociation::class);
        $this->assertClassHasAttribute('application', ProfileAssociation::class);
    }

    public function testIdAccessors()
    {
        $profileAssociationReturn = $this->profileAssociation->setId(1);
        $this->assertEquals(1, $this->profileAssociation->getId());
        $this->assertAttributeEquals(1, 'id', $this->profileAssociation);
        $this->assertEquals($profileAssociationReturn, $this->profileAssociation);
    }

    public function testProfileAccessors()
    {
        $profileAssociationReturn = $this->profileAssociation->setProfile($this->profile);
        $this->assertEquals($this->profile, $this->profileAssociation->getProfile());
        $this->assertAttributeEquals($this->profile, 'profile', $this->profileAssociation);
        $this->assertEquals($profileAssociationReturn, $this->profileAssociation);
    }

    public function testRoleAccessors()
    {
        $profileAssociationReturn = $this->profileAssociation->setRole($this->role);
        $this->assertEquals($this->role, $this->profileAssociation->getRole());
        $this->assertAttributeEquals($this->role, 'role', $this->profileAssociation);
        $this->assertEquals($profileAssociationReturn, $this->profileAssociation);
    }

    public function testUserAccessors()
    {
        $profileAssociationReturn = $this->profileAssociation->setUser($this->user);
        $this->assertEquals($this->user, $this->profileAssociation->getUser());
        $this->assertAttributeEquals($this->user, 'user', $this->profileAssociation);
        $this->assertEquals($profileAssociationReturn, $this->profileAssociation);
    }

    public function testApplicationAccessors()
    {
        $profileAssociationReturn = $this->profileAssociation->setApplication($this->application);
        $this->assertEquals($this->application, $this->profileAssociation->getApplication());
        $this->assertAttributeEquals($this->application, 'application', $this->profileAssociation);
        $this->assertEquals($profileAssociationReturn, $this->profileAssociation);
    }
}
