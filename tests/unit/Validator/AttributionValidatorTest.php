<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Validator\AttributionValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributionValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class AttributionValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new AttributionValidator();

        $user = (new User())
            ->setUserName('toto')
            ->setPassword('toto')
            ->setFirstName('toto')
            ->setLastName('toto')
            ->setEmail('toto@toto.com');

        $application = (new Application())
            ->setName('toto')
            ->setUrl('http://www.toto.com');

        $role = (new Role())
            ->setRole('toto')
            ->setLabel('titi');

        $attribution = (new Attribution())
            ->setUser($user)
            ->setApplication($application)
            ->setRole($role)
            ->setIsDefault(true);

        $this->assertTrue($validator->validate($attribution));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateNoAttributionEntity()
    {
        $validator = new AttributionValidator();

        $this->setExpectedException(
            Exception::class,
            'The Entity to validate must be an instance of ' . Attribution::class
        );

        $validator->validate(new Role());
    }

    public function testValidateUser()
    {
        $user = new User();

        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateUser($user));
        $this->assertRegExp('/^(user: User must be a valid instance of User class - )/', $validator->getErrorsAsString());

        $user->setUserName('toto')
            ->setPassword('toto')
            ->setFirstName('toto')
            ->setLastName('toto')
            ->setEmail('toto@toto.com');

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateUser($user));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateApplication()
    {
        $application = new Application();

        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateApplication($application));
        $this->assertRegExp('/^(application: Application must be a valid instance of Application class - )/', $validator->getErrorsAsString());

        $application->setName('toto')
                    ->setUrl('http://www.toto.com');

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateApplication($application));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateRole()
    {
        $role = new Role();

        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateRole($role));
        $this->assertRegExp('/^(role: Role must be a valid instance of Role class - )/', $validator->getErrorsAsString());

        $role->setRole('toto')->setLabel('titi');

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateRole($role));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateIsDefault()
    {
        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateIsDefault("true"));
        $this->assertRegExp('/^(is_default: Is default must be a boolean or 0 or 1)/', $validator->getErrorsAsString());

        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateIsDefault("false"));
        $this->assertRegExp('/^(is_default: Is default must be a boolean or 0 or 1)/', $validator->getErrorsAsString());

        $validator = new AttributionValidator();
        $this->assertFalse($validator->validateIsDefault('10'));
        $this->assertRegExp('/^(is_default: Is default must be a boolean or 0 or 1)/', $validator->getErrorsAsString());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault(true));
        $this->assertEmpty($validator->getErrors());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault(false));
        $this->assertEmpty($validator->getErrors());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault(0));
        $this->assertEmpty($validator->getErrors());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault(1));
        $this->assertEmpty($validator->getErrors());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault('0'));
        $this->assertEmpty($validator->getErrors());

        $validator = new AttributionValidator();
        $this->assertTrue($validator->validateIsDefault('1'));
        $this->assertEmpty($validator->getErrors());
    }
}
