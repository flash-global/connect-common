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
            ->setLogoUrl('http://test.com');

        $this->assertTrue($validator->validate($application));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateNoApplicationEntity()
    {
        $validator = new ApplicationValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The Entity to validate must be an instance of ' . Application::class);

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

    public function testValidateStatus()
    {
        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateStatus(null));
        $this->assertEquals('Status cannot be null', $validator->getErrors()['status'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateStatus('dqsd'));
        $this->assertEquals('Status must be equal to 1 or 2', $validator->getErrors()['status'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateStatus(10));
        $this->assertEquals('Status must be equal to 1 or 2', $validator->getErrors()['status'][0]);

        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateStatus(Application::STATUS_ENABLED));
    }

    public function testValidateLogoUrl()
    {
        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateLogoUrl(''));
        $this->assertTrue($validator->validateLogoUrl(null));

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateLogoUrl(true));
        $this->assertEquals('Url must be a string', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateLogoUrl(str_repeat('☃', 256)));
        $this->assertEquals('Url length has to be less or equal to 255', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateLogoUrl('toto'));
        $this->assertEquals('Url must contain protocol and domain name', $validator->getErrors()['url'][0]);

        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateLogoUrl('http://www.toto.com'));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateAllowProfileAssociation()
    {
        $validator = new ApplicationValidator();
        $this->assertTrue($validator->validateAllowProfileAssociation(true));
        $this->assertTrue($validator->validateAllowProfileAssociation(false));
        $this->assertTrue($validator->validateAllowProfileAssociation(0));
        $this->assertTrue($validator->validateAllowProfileAssociation(1));
        $this->assertTrue($validator->validateAllowProfileAssociation("1"));
        $this->assertTrue($validator->validateAllowProfileAssociation("0"));

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateAllowProfileAssociation(null));
        $this->assertEquals(
            'Allow profile association must be a boolean or 0 or 1',
            $validator->getErrors()['allow_profile_association'][0]
        );

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateAllowProfileAssociation('toto'));
        $this->assertEquals(
            'Allow profile association must be a boolean or 0 or 1',
            $validator->getErrors()['allow_profile_association'][0]
        );

        $validator = new ApplicationValidator();
        $this->assertFalse($validator->validateAllowProfileAssociation('10'));
        $this->assertEquals(
            'Allow profile association must be a boolean or 0 or 1',
            $validator->getErrors()['allow_profile_association'][0]
        );
    }
}
