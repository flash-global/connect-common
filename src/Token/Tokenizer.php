<?php

namespace Fei\Service\Connect\Common\Token;

use Fei\Service\Connect\Common\Entity\User;

/**
 * Class Token
 *
 * @package Fei\Service\Connect\Client
 */
class Tokenizer
{
    /**
     * Create a unique token
     *
     * @return string
     */
    public function createToken()
    {
        return sha1(uniqid('', true));
    }

    /**
     * Create a request for a token with an User entity
     *
     * @param User   $user
     * @param string $issuer
     *
     * @return TokenRequest
     */
    public function createTokenRequest(User $user, $issuer)
    {
        $idAttribution = $user->getCurrentAttribution() ? $user->getCurrentAttribution()->getId() : null;

        return (new TokenRequest())
            ->setUsername($user->getUserName())
            ->setAttributionId($idAttribution)
            ->setIssuer($issuer);
    }


    /**
     * Create a request for a token with an Application
     *
     * @param string $application
     *
     * @return TokenRequest
     */
    public function createApplicationTokenRequest($application)
    {
        return (new TokenRequest())
            ->setIssuer($application);
    }

    /**
     * Sign a request token
     *
     * @param TokenRequest    $tokenRequest
     * @param resource|string $privateKey
     *
     * @return TokenRequest
     */
    public function signTokenRequest(TokenRequest $tokenRequest, $privateKey)
    {
        openssl_sign($tokenRequest->getIssuer() . ':' . $tokenRequest->getUsername(), $signature, $privateKey);

        return $tokenRequest->setSignature(base64_encode($signature));
    }

    /**
     * Verify the signature
     *
     * @param TokenRequest    $tokenRequest
     * @param resource|string $certificate
     *
     * @return bool
     */
    public function verifySignature(TokenRequest $tokenRequest, $certificate)
    {
        $result = openssl_verify(
            $tokenRequest->getIssuer() . ':' . $tokenRequest->getUsername(),
            base64_decode($tokenRequest->getSignature()),
            $certificate
        );

        return $result === 1 ? true : false;
    }

    /**
     * Validate a request token
     *
     * @param TokenRequest $requestToken
     * @param resource|string $certificate
     *
     * @return bool
     */
    public function validateRequestToken(TokenRequest $requestToken, $certificate = null)
    {
        if (empty($requestToken->getIssuer()) || empty($requestToken->getSignature())) {
            return false;
        }

        if (!is_null($certificate)) {
            return $this->verifySignature($requestToken, $certificate);
        }

        return true;
    }
}
