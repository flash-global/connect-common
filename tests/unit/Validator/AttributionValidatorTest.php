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
}
