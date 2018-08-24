<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Entity\UserGroup;
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

        $attribution = (new Attribution())
            ->setSource(
                (new User())
                    ->setUserName('toto')
                    ->setPassword('toto')
                    ->setFirstName('toto')
                    ->setLastName('toto')
                    ->setEmail('toto@toto.com')
                    ->setAvatarUrl('http://toto.com')
                    ->setMiniAvatarUrl('http://toto.com')
                    ->setLanguage('fr')
            )
            ->setTarget(
                (new Application())
                    ->setName('toto')
                    ->setUrl('http://www.toto.com')
                    ->setLogoUrl('http://test.com')
            )
            ->setRole(
                (new Role())
                    ->setRole('toto')
                    ->setLabel('titi')
            );

        $this->assertTrue($validator->validate($attribution));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateWrongEntity()
    {
        $this->expectException(\Exception::class);

        $validator = new AttributionValidator();

        $validator->validate(new TestEntity());
    }

    public function testValidateTarget()
    {
        $validator = new AttributionValidator();
        $appGroup = (new ApplicationGroup())
            ->setName('name');

        $this->assertTrue($validator->validateTarget($appGroup));
    }

    public function testValidateTargetWrongInstance()
    {
        $validator = new AttributionValidator();
        $appGroup = (new User());

        $this->assertFalse($validator->validateTarget($appGroup));
    }

    public function testValidateTargetInstanceErrorValidation()
    {
        $validator = new AttributionValidator();
        $appGroup = (new ApplicationGroup());

        $this->assertFalse($validator->validateTarget($appGroup));
    }

    public function testValidateSource()
    {
        $validator = new AttributionValidator();
        $appGroup = (new UserGroup())
            ->setDefaultRole(new Role())
            ->setName('name');

        $this->assertTrue($validator->validateSource($appGroup));
    }

    public function testValidateSourceWrongInstance()
    {
        $validator = new AttributionValidator();
        $appGroup = (new Application())
            ->setName('name');

        $this->assertFalse($validator->validateSource($appGroup));
    }

    public function testValidateSourceInstanceErrorValidation()
    {
        $validator = new AttributionValidator();
        $appGroup = (new UserGroup());

        $this->assertFalse($validator->validateSource($appGroup));
    }

    public function testValidateRoleInstanceErrorValidation()
    {
        $validator = new AttributionValidator();
        $appGroup = (new Role());

        $this->assertFalse($validator->validateRole($appGroup));
    }
}

class TestEntity implements EntityInterface
{
    public function hydrate($data)
    {
        // TODO: Implement hydrate() method.
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

}
