<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
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
            ->setAvatarUrl('http://toto.com')
            ->setMiniAvatarUrl('http://toto.com')
            ->setLanguage('fr');

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

    public function testValidateRegisterToken()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateRegisterToken(str_repeat('☃', 256)));
        $this->assertEquals(
            'Register token length has to be less or equal to 36',
            $validator->getErrors()['registerToken'][0]
        );
    }

    public function testValidateStatus()
    {
        $validator = new UserValidator();
        $this->assertFalse($validator->validateStatus(null));
        $this->assertEquals('Status cannot be null', $validator->getErrors()['status'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateStatus('dqsd'));
        $this->assertEquals('Status must be equal to 0, 1, 2 or 3', $validator->getErrors()['status'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateStatus(10));
        $this->assertEquals('Status must be equal to 0, 1, 2 or 3', $validator->getErrors()['status'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateStatus(User::STATUS_ACTIVE));
    }

    public function testValidateAvatarUrl()
    {
        $validator = new UserValidator();
        $this->assertTrue($validator->validateAvatarUrl(''));
        $this->assertTrue($validator->validateAvatarUrl(null));

        $validator = new UserValidator();
        $this->assertFalse($validator->validateAvatarUrl(true));
        $this->assertEquals('Url must be a string', $validator->getErrors()['url'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateAvatarUrl(str_repeat('☃', 256)));
        $this->assertEquals('Url length has to be less or equal to 255', $validator->getErrors()['url'][0]);

        $validator = new UserValidator();
        $this->assertFalse($validator->validateAvatarUrl('toto'));
        $this->assertEquals('Url must contain protocol and domain name', $validator->getErrors()['url'][0]);

        $validator = new UserValidator();
        $this->assertTrue($validator->validateAvatarUrl('http://www.toto.com'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateLanguage()
    {
        $validator = new UserValidator();
        $this->assertTrue($validator->validateLanguage('fr'));

        // Only this format is correct: fr_FR
        $this->assertTrue($validator->validateLanguage('fr_FR'));
        $this->assertFalse($validator->validateLanguage('FR_FR'));
        $this->assertFalse($validator->validateLanguage('fr_fr'));
        $this->assertFalse($validator->validateLanguage('fr-FR'));
        $this->assertFalse($validator->validateLanguage('fr_FRA'));
        $this->assertFalse($validator->validateLanguage(null));
        $this->assertFalse($validator->validateLanguage(''));
    }

    public function testValidateDefaultAttribution()
    {
        $validator = new UserValidator();

        $this->assertTrue($validator->validateDefaultAttribution(
            new ArrayCollection([
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(1)
                    )
                    ->setUser(
                        (new User())
                            ->setId(1)
                    )
                    ->setIsDefault(true),
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(1)
                    )
                    ->setUser(
                        (new User())
                            ->setId(1)
                    )
                    ->setIsDefault(false),
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(2)
                    )
                    ->setUser(
                        (new User())
                            ->setId(1)
                    )
                    ->setIsDefault(true),
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(1)
                    )
                    ->setUser(
                        (new User())
                            ->setId(2)
                    )
                    ->setIsDefault(true)
            ])
        ));
        $this->assertEmpty($validator->getErrors());

        $this->assertFalse($validator->validateDefaultAttribution(
            new ArrayCollection([
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(1)
                    )
                    ->setUser(
                        (new User())
                            ->setId(1)
                    )
                    ->setIsDefault(true),
                (new Attribution())
                    ->setApplication(
                        (new Application())
                            ->setId(1)
                    )
                    ->setUser(
                        (new User())
                            ->setId(1)
                    )
                    ->setIsDefault(true)
            ])
        ));
        $this->assertEquals('It can\'t be more than one default attribution by application by user', $validator->getErrors()['attributions'][0]);
    }
}
