<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Token\Tokenizer;
use Fei\Service\Connect\Common\Token\TokenRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenizerTest
 */
class TokenizerTest extends TestCase
{
    public function testCreateToken()
    {
        $token = (new Tokenizer())->createToken();

        $this->assertEquals(40, strlen($token));
        $this->assertRegExp('/[[:alnum:]]/', $token);
    }

    public function testCreateTokenRequest()
    {
        $request = (new Tokenizer())->createTokenRequest(new User(['username' => 'username']), 'issuer');

        $this->assertInstanceOf(TokenRequest::class, $request);
        $this->assertEquals('username', $request->getUsername());
        $this->assertEquals('issuer', $request->getIssuer());
        $this->assertEquals(null, $request->getAttributionId());
    }

    public function testCreateTokenRequestWithNullAttributionId()
    {
        $request = (new Tokenizer())->createTokenRequest(
            new User([
                'username' => 'username',
                'current_attribution' => null
            ]),
            'issuer'
        );

        $this->assertInstanceOf(TokenRequest::class, $request);
        $this->assertEquals('username', $request->getUsername());
        $this->assertEquals('issuer', $request->getIssuer());
        $this->assertEquals(null, $request->getAttributionId());
    }

    public function testCreateTokenRequestWithAttributionId()
    {
        $request = (new Tokenizer())->createTokenRequest(
            new User([
                'username' => 'username',
                'current_attribution' => [
                    'id' => 1
                ]
            ]),
            'issuer'
        );

        $this->assertInstanceOf(TokenRequest::class, $request);
        $this->assertEquals('username', $request->getUsername());
        $this->assertEquals('issuer', $request->getIssuer());
        $this->assertEquals(1, $request->getAttributionId());
    }

    public function testCreateApplicationTokenRequest()
    {
        $request = (new Tokenizer())->createApplicationTokenRequest('test');

        $this->assertInstanceOf(TokenRequest::class, $request);
        $this->assertNull($request->getUsername());
        $this->assertEquals('test', $request->getIssuer());
    }

    public function testSignTokenRequest()
    {
        $tokenizer = new Tokenizer();

        $request = $tokenizer->createTokenRequest(new User(['username' => 'username']), 'issuer');

        $request = $tokenizer->signTokenRequest($request, 'file://' . __DIR__ . '/../data/sp.pem');

        $this->assertEquals(
            1,
            openssl_verify(
                $request->getIssuer() . ':' . $request->getUsername(),
                base64_decode($request->getSignature()),
                'file://' . __DIR__ . '/../data/sp.crt'
            )
        );
    }

    public function testVerifySignature()
    {
        $tokenizer = new Tokenizer();

        $request = $tokenizer->createTokenRequest(new User(['username' => 'vincent']), 'http://shaq.dev:8086');

        $request = $tokenizer->signTokenRequest($request, 'file://' . __DIR__ . '/../data/sp.pem');

        $this->assertTrue(
            $tokenizer->verifySignature($request, 'file://' . __DIR__ . '/../data/sp.crt')
        );
    }

    public function testValidateRequestToken()
    {
        $this->assertTrue(
            (new Tokenizer())
                ->validateRequestToken(
                    (new Tokenizer())->signTokenRequest(
                        (new TokenRequest())
                            ->setUsername('test')
                            ->setIssuer('test'),
                        'file://' . __DIR__ . '/../data/sp.pem'
                    ),
                    'file://' . __DIR__ . '/../data/sp.crt'
                )
        );
    }

    public function testValidateRequestTokenWithOutCert()
    {
        $this->assertTrue(
            (new Tokenizer())
                ->validateRequestToken(
                    (new Tokenizer())->signTokenRequest(
                        (new TokenRequest())
                            ->setUsername('test')
                            ->setIssuer('test'),
                        'file://' . __DIR__ . '/../data/sp.pem'
                    )
                )
        );
    }

    public function testValidateRequestWithBadSignature()
    {
        $this->assertFalse(
            (new Tokenizer())
                ->validateRequestToken(
                    (new TokenRequest())
                        ->setUsername('test')
                        ->setIssuer('test')
                        ->setSignature('badsign'),
                    'file://' . __DIR__ . '/../data/sp.crt'
                )
        );
    }

    public function testValidateRequestWithBadRequest()
    {
        $this->assertFalse(
            (new Tokenizer())
                ->validateRequestToken(
                    (new TokenRequest())
                        ->setUsername('')
                        ->setIssuer('test'),
                    'file://' . __DIR__ . '/../data/sp.crt'
                )
        );
    }
}
