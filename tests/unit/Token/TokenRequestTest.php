<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Token\TokenRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenRequestTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class TokenRequestTest extends TestCase
{
    public function testIssuerAccessor()
    {
        $tokenRequest = new TokenRequest();

        $tokenRequest->setIssuer('issuer');

        $this->assertEquals('issuer', $tokenRequest->getIssuer());
        $this->assertAttributeEquals($tokenRequest->getIssuer(), 'issuer', $tokenRequest);
    }

    public function testUsernameAccessor()
    {
        $tokenRequest = new TokenRequest();

        $tokenRequest->setUsername('username');

        $this->assertEquals('username', $tokenRequest->getUsername());
        $this->assertAttributeEquals($tokenRequest->getUsername(), 'username', $tokenRequest);
    }

    /**
     * @dataProvider dataAttributionAccessor
     */
    public function testAttributionAccessor($attributionId)
    {
        $tokenRequest = new TokenRequest();

        $tokenRequest->setAttributionId($attributionId);

        $this->assertEquals($attributionId, $tokenRequest->getAttributionId());
        $this->assertAttributeEquals($tokenRequest->getAttributionId(), 'attributionId', $tokenRequest);
    }

    public function dataAttributionAccessor()
    {
        return [
            0 => [
                1
            ],
            1 => [
                null
            ]
        ];
    }

    public function testSignatureAccessor()
    {
        $tokenRequest = new TokenRequest();

        $tokenRequest->setSignature('signature');

        $this->assertEquals('signature', $tokenRequest->getSignature());
        $this->assertAttributeEquals($tokenRequest->getSignature(), 'signature', $tokenRequest);
    }
}
