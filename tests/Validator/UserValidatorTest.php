<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Validator\UserValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class UserValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class UserValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new UserValidator();

        $user = (new User())
            ->setUserName('toto')
            ->setPassword('toto')
            ->setFirstName('toto')
            ->setLastName('toto')
            ->setEmail('toto@toto.com')
        ;

        $this->assertTrue($validator->validate($user));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateNoUserEntity()
    {
        $validator = new UserValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            'The Entity to validate must be an instance of ' . User::class
        );

        $validator->validate(new Role());
    }

    public function testValidatePassword()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validatePassword(''));
        $this->assertEquals('Password cannot be empty', $validator->getErrors()['password'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validatePassword(str_repeat('☃', 256)));
        $this->assertEquals('Password length has to be less or equal to 255', $validator->getErrors()['password'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validatePassword('test'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateUserName()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateUserName(''));
        $this->assertEquals('User name cannot be empty', $validator->getErrors()['userName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateUserName(true));
        $this->assertEquals('User name must be a string', $validator->getErrors()['userName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateUserName(str_repeat('☃', 256)));
        $this->assertEquals('User name length has to be less or equal to 255', $validator->getErrors()['userName'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateUserName('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateFirstName()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateFirstName(''));
        $this->assertEquals('First name cannot be empty', $validator->getErrors()['firstName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateFirstName(true));
        $this->assertEquals('First name must be a string', $validator->getErrors()['firstName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateFirstName(str_repeat('☃', 256)));
        $this->assertEquals('First name length has to be less or equal to 255', $validator->getErrors()['firstName'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateFirstName('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateLastName()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateLastName(''));
        $this->assertEquals('Last name cannot be empty', $validator->getErrors()['lastName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateLastName(true));
        $this->assertEquals('Last name must be a string', $validator->getErrors()['lastName'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateLastName(str_repeat('☃', 256)));
        $this->assertEquals('Last name length has to be less or equal to 255', $validator->getErrors()['lastName'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateLastName('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateEmail()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateEmail(''));
        $this->assertEquals('Email cannot be empty', $validator->getErrors()['email'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateEmail('toto'));
        $this->assertEquals('Email must be an email address', $validator->getErrors()['email'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateEmail(str_repeat('☃', 256)));
        $this->assertEquals('Email length has to be less or equal to 255', $validator->getErrors()['email'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateEmail('toto@toto.fr'));
        $this->assertEmpty($validator->getErrors());
    }


    public function testValidateCreatedAt()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateCreatedAt(''));
        $this->assertEquals('Creation date and time cannot be empty', $validator->getErrors()['createdAt'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateCreatedAt('test'));
        $this->assertEquals(
            'The creation date has to be and instance of \DateTime',
            $validator->getErrors()['createdAt'][0]
        );

        $validator = new UserValidator();
        $this->assertTrue($validator->validateCreatedAt(new \DateTime()));
        $this->assertEmpty($validator->getErrors());
    }
}
