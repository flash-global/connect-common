<?php

namespace Test\Fei\Service\Connect\Common\Validator;


use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Entity\UserGroup;
use Fei\Service\Connect\Common\Validator\ApplicationGroupValidator;
use Fei\Service\Connect\Common\Validator\ApplicationValidator;
use Fei\Service\Connect\Common\Validator\UserGroupValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class UserGroupValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class UserGroupValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new UserGroupValidator();

        $users = new ArrayCollection();
        $users->add((new User()));

        $userGroup = (new UserGroup())
            ->setUsers($users)
            ->setDefaultRole((new Role()))
            ->setName('toto');

        $this->assertTrue($validator->validate($userGroup));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateEntityError()
    {
        $this->expectException(\Exception::class);
        $validator = new UserGroupValidator();

        $validator->validate(new User());
    }

    public function testValidateRoleWrongEntity()
    {
        $validator = new UserGroupValidator();

        $this->assertFalse($validator->validateDefaultRole('test'));
    }

    public function providerName()
    {
        return [
            [''],
            [21],
            [str_repeat('a', 270)]
        ];
    }

    /**
     * @dataProvider providerName
     */
    public function testValidateNameError($name)
    {
        $validator = new UserGroupValidator();

        $userGroup = (new UserGroup())
            ->setName($name);

        $this->assertFalse($validator->validate($userGroup));
        $this->assertNotEmpty($validator->getErrors());
    }
}
