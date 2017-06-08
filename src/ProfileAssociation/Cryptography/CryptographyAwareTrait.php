<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Cryptography;

/**
 * Trait CryptographyAwareTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
trait CryptographyAwareTrait
{
    /**
     * @var Cryptography
     */
    protected $cryptography;

    /**
     * Get Cryptography
     *
     * @return Cryptography
     */
    public function getCryptography()
    {
        if (is_null($this->cryptography)) {
            $this->cryptography = new Cryptography();
        }

        return $this->cryptography;
    }

    /**
     * Set Cryptography
     *
     * @param Cryptography $cryptography
     *
     * @return $this
     */
    public function setCryptography(Cryptography $cryptography)
    {
        $this->cryptography = $cryptography;

        return $this;
    }
}
