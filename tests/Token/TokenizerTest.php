<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Token\Tokenizer;
use Lcobucci\JWT\Token;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenizerTest
 */
class TokenizerTest extends TestCase
{
    public function testCreateToken()
    {
        $tokenizer = new Tokenizer();

        $user = (new User())
            ->setUserName('test');

        $t = $tokenizer->createToken(
            $user,
            'http://sp.dev:8080',
            file_get_contents('file://' . __DIR__ . '/../data/idp.pem')
        );

        $this->assertInstanceOf(Token::class, $t);
        $this->assertEquals('http://sp.dev:8080', $t->getClaim('iss'));
        $this->assertEquals(['typ' => 'JWT', 'alg' => 'RS256'], $t->getHeaders());

        $tokenize = new User(json_decode($t->getClaim('user_entity'), true));

        $this->assertEquals($user, $tokenize);
        $this->assertEquals($user->getUserName(), $tokenize->getUserName());
    }

    public function testParseFromString()
    {
        $tokenizer = new Tokenizer();

        $user = (new User())
            ->setUserName('test');

        $token = $tokenizer->createToken(
            $user,
            'http://sp.dev:8080',
            file_get_contents('file://' . __DIR__ . '/../data/idp.pem')
        );

        $this->assertEquals($token, $tokenizer->parseFromString((string) $token));
    }

    public function testVerifySignature()
    {
        $tokenizer = new Tokenizer();

        $user = (new User())
            ->setUserName('test');

        $token = $tokenizer->createToken(
            $user,
            'http://sp.dev:8080',
            file_get_contents('file://' . __DIR__ . '/../data/idp.pem')
        );

        $this->assertTrue(
            $tokenizer->verifySignature($token, file_get_contents('file://' . __DIR__ . '/../data/idp.crt'))
        );
    }

    public function testExtractUser()
    {
        $tokenizer = new Tokenizer();

        $user = (new User())
            ->setUserName('vincent');

        $token = $tokenizer->createToken(
            $user,
            'http://shaq.dev:8086',
            file_get_contents('file://' . __DIR__ . '/../data/sp.pem')
        );

        $token = $tokenizer->parseFromString((string) $token);

        $newUser = $tokenizer->extractUser($token);

        $this->assertEquals($user, $newUser);
    }
}
