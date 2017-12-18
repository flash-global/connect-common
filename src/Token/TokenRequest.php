<?php

namespace Fei\Service\Connect\Common\Token;

use Fei\Entity\AbstractEntity;
use Fei\Service\Connect\Common\Entity\Attribution;

/**
 * Class TokenRequest
 *
 * @package Fei\Service\Connect\Common\Token
 */
class TokenRequest extends AbstractEntity
{
    /**
     * @var string
     */
    protected $issuer;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var integer|null
     */
    protected $attributionId;

    /**
     * @var string
     */
    protected $signature;

    /**
     * Get Issuer
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Set Issuer
     *
     * @param string $issuer
     *
     * @return $this
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Get Username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Username
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get AttributionId
     *
     * @return int|null
     */
    public function getAttributionId()
    {
        return $this->attributionId;
    }

    /**
     * Set AttributionId
     *
     * @param int|null $attributionId
     *
     * @return $this
     */
    public function setAttributionId($attributionId)
    {
        $this->attributionId = $attributionId;
        return $this;
    }

    /**
     * Get Signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set Signature
     *
     * @param string $signature
     *
     * @return $this
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }
}
