<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\OAuth;
use PHPUnit\Framework\TestCase;

/**
 * Class OAuthTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class OAuthTest extends TestCase
{
    public function testAccessors()
    {
        $this->oneAccessors('id', 25);
        $this->oneAccessors('name', 'name');
        $this->oneAccessors('clientId', 'clientid');
        $this->oneAccessors('clientSecret', 'clientsecret');
        $this->oneAccessors('redirectUri', 'redirecturi');
        $this->oneAccessors('hostedDomain', 'hosteddomain');
        $this->oneAccessors('graphApiVersion', 'v2.8');
        $this->oneAccessors('provider', 'google');
        $this->oneAccessors('status', 2);
    }

    protected function oneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $entity = new OAuth();
        $entity->$setter($expected);
        $this->assertEquals($entity->$getter(), $expected);
        $this->assertAttributeEquals($entity->$getter(), $name, $entity);
    }
}
