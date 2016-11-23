<?php

namespace Test\Fei\Service\Connect\Common\Validator;


use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Validator\ApplicationValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class ApplicationValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class ApplicationValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new ApplicationValidator();

        $application = (new Application())
            ->setName('toto')
            ->setUrl('http://www.toto.com')
        ;

        $this->assertTrue($validator->validate($application));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateNoApplicationEntity()
    {
        $validator = new ApplicationValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            'The Entity to validate must be an instance of ' . Application::class
        );

        $validator->validate(new User());
    }

    public function testValidateName()
    {
        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateName(''));
        $this->assertEquals('Name cannot be empty', $validator->getErrors()['name'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateName(true));
        $this->assertEquals('Name must be a string', $validator->getErrors()['name'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateName(str_repeat('☃', 256)));
        $this->assertEquals('Name length has to be less or equal to 255', $validator->getErrors()['name'][0]);

        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateName('toto'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateUrl()
    {
        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateUrl(''));
        $this->assertEquals('Url cannot be empty', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateUrl(true));
        $this->assertEquals('Url must be a string', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateUrl(str_repeat('☃', 256)));
        $this->assertEquals('Url length has to be less or equal to 255', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateUrl('toto'));
        $this->assertEquals('Url must contain protocol and domain name', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateUrl('http://www.toto.com'));
        $this->assertEmpty($validator->getErrors());
    }
}
