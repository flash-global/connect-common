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
            ->setUserName('toto');

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
}
