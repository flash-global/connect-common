<?php

namespace Test\Fei\Service\Connect\Common\Validator;


use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Validator\ApplicationGroupValidator;
use Fei\Service\Connect\Common\Validator\ApplicationValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class ApplicationGroupValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class ApplicationGroupValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new ApplicationGroupValidator();

        $applications = new ArrayCollection();
        $applications->add((new Application()));

        $applicationGroup = (new ApplicationGroup())
            ->setApplications($applications)
            ->setName('toto');

        $this->assertTrue($validator->validate($applicationGroup));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateEntityError()
    {
        $this->expectException(\Exception::class);
        $validator = new ApplicationGroupValidator();

        $validator->validate(new User());
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
        $validator = new ApplicationGroupValidator();

        $applicationGroup = (new ApplicationGroup())
            ->setName($name);

        $this->assertFalse($validator->validate($applicationGroup));
        $this->assertNotEmpty($validator->getErrors());
    }
}
