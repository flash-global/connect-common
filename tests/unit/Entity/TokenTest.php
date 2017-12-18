<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Token;
use Fei\Service\Connect\Common\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenTest
 *
 * @package Test\Fei\Service\Connect\Common\Entity
 */
class TokenTest extends TestCase
{
    public function testIdAccessors()
    {
        $token = new Token();

        $token->setId(1);

        $this->assertEquals(1, $token->getId());
        $this->assertAttributeEquals($token->getId(), 'id', $token);
    }

    public function testCreatedAtAccessors()
    {
        $token = new Token();

        $date = new \DateTime();

        $token->setCreatedAt($date);

        $this->assertEquals($date, $token->getCreatedAt());
        $this->assertAttributeEquals($token->getCreatedAt(), 'createdAt', $token);

        $token->setCreatedAt('2017-06-30 00:00:00');

        $this->assertEquals(new \DateTime('2017-06-30 00:00:00'), $token->getCreatedAt());
    }

    public function testTokenAccessors()
    {
        $token = new Token();

        $token->setToken('token');

        $this->assertEquals('token', $token->getToken());
        $this->assertAttributeEquals($token->getToken(), 'token', $token);
    }

    public function testUserAccessors()
    {
        $token = new Token();

        $token->setUser(new User());

        $this->assertEquals(new User(), $token->getUser());
        $this->assertAttributeEquals($token->getUser(), 'user', $token);
    }

    public function testExpirationAccessors()
    {
        $token = new Token();

        $expected = new \DateTime('2018-12-12');

        $token->setExpiration($expected);

        $this->assertEquals($expected, $token->getExpiration());
        $this->assertAttributeEquals($token->getExpiration(), 'expiration', $token);
    }

    public function testApplicationAccessors()
    {
        $token = new Token();

        $application = new Application();

        $token->setApplication($application);

        $this->assertEquals($application, $token->getApplication());
        $this->assertAttributeEquals($token->getApplication(), 'application', $token);
    }

    public function testAttributionAccessors()
    {
        $token = new Token();

        $token->setAttribution(new Attribution());

        $this->assertEquals(new Attribution(), $token->getAttribution());
        $this->assertAttributeEquals($token->getAttribution(), 'attribution', $token);
    }

    public function testAttributionAccessorsNull()
    {
        $token = new Token();

        $token->setAttribution(null);

        $this->assertEquals(null, $token->getAttribution());
        $this->assertAttributeEquals($token->getAttribution(), 'attribution', $token);
    }
}
