<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Validator\RoleValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class RoleValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class RoleValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new RoleValidator();

        $role = (new Role())
            ->setRole('toto')
            ->setLabel('titi');

        $this->assertTrue($validator->validate($role));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateNoRoleEntity()
    {
        $validator = new RoleValidator();

        $this->setExpectedException(Exception::class, 'The Entity to validate must be an instance of ' . Role::class);

        $validator->validate(new User());
    }

    public function testValidateRole()
    {
        $validator = new RoleValidator();
        $this->assertFalse($validator->validateRole(''));
        $this->assertEquals('Role cannot be empty', $validator->getErrors()['role'][0]);

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateRole(true));
        $this->assertEquals('Role must be a string', $validator->getErrors()['role'][0]);

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateRole(str_repeat('☃', 256)));
        $this->assertEquals('Role length has to be less or equal to 255', $validator->getErrors()['role'][0]);

        $validator = new RoleValidator();
        $this->assertTrue($validator->validateRole('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateLabel()
    {
        $validator = new RoleValidator();
        $this->assertFalse($validator->validateLabel(''));
        $this->assertEquals('Label cannot be empty', $validator->getErrors()['label'][0]);

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateLabel(true));
        $this->assertEquals('Label must be a string', $validator->getErrors()['label'][0]);

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateLabel(str_repeat('☃', 256)));
        $this->assertEquals('Label length has to be less or equal to 255', $validator->getErrors()['label'][0]);

        $validator = new RoleValidator();
        $this->assertTrue($validator->validateLabel('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateRoleValidator()
    {
        $validator = new RoleValidator();
        $this->assertTrue($validator->validateUserCreated(true));
        $this->assertTrue($validator->validateUserCreated(false));
        $this->assertTrue($validator->validateUserCreated(0));
        $this->assertTrue($validator->validateUserCreated(1));
        $this->assertTrue($validator->validateUserCreated("1"));
        $this->assertTrue($validator->validateUserCreated("0"));

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateUserCreated(null));
        $this->assertEquals(
            'User created must be a boolean or 0 or 1',
            $validator->getErrors()['user_created'][0]
        );

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateUserCreated('toto'));
        $this->assertEquals(
            'User created must be a boolean or 0 or 1',
            $validator->getErrors()['user_created'][0]
        );

        $validator = new RoleValidator();
        $this->assertFalse($validator->validateUserCreated('10'));
        $this->assertEquals(
            'User created must be a boolean or 0 or 1',
            $validator->getErrors()['user_created'][0]
        );
    }
}
