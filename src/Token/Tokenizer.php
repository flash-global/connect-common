<?php

namespace Fei\Service\Connect\Common\Token;

use Fei\Service\Connect\Common\Entity\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;

/**
 * Class Token
 *
 * @package Fei\Service\Connect\Client
 */
class Tokenizer
{
    /**
     * Get a Builder instance
     *
     * @return Builder
     */
    public function createBuilderInstance()
    {
        return new Builder();
    }

    /**
     * Get a Parser instance
     *
     * @return Parser
     */
    public function createParserInstance()
    {
        return new Parser();
    }

    /**
     * Create a token with an User entity
     *
     * @param User   $user
     * @param string $issuer
     * @param string $privateKey
     *
     * @return Token
     */
    public function createToken(User $user, $issuer, $privateKey)
    {
        return $this->createBuilderInstance()
            ->setIssuer($issuer)
            ->set('user_entity', json_encode($user->toArray()))
            ->sign(new Sha256(), $privateKey)
            ->getToken();
    }

    /**
     * Parse and return a Token from a string
     *
     * @param string $string
     *
     * @return Token
     */
    public function parseFromString($string)
    {
        return $this->createParserInstance()->parse($string);
    }

    /**
     * Verify the token's signature
     *
     * @param Token  $token
     * @param string $certificate
     *
     * @return bool
     */
    public function verifySignature(Token $token, $certificate)
    {
        return $token->verify(new Sha256(), $certificate);
    }

    /**
     * Extract a User instance from Token
     *
     * @param Token $token
     *
     * @return User|null
     */
    public function extractUser(Token $token)
    {
        $user = $token->getClaim('user_entity', null);

        return $user ? new User(json_decode($user, true)) : $user;
    }
}
