<?php

namespace Fei\Service\Connect\Common\Cryptography;

use phpseclib\Crypt\RSA;

/**
 * Class KeyGen
 *
 * @package Fei\Service\Connect\Common\Crypt
 */
class RsaKeyGen
{
    /**
     * @var int Private key size in bits
     */
    protected $privateKeySize = 1024;

    /**
     * Get PrivateKeySize
     *
     * @return int
     */
    public function getPrivateKeySize()
    {
        return $this->privateKeySize;
    }

    /**
     * Set PrivateKeySize
     *
     * @param int $privateKeySize
     *
     * @return $this
     */
    public function setPrivateKeySize($privateKeySize)
    {
        $this->privateKeySize = $privateKeySize;

        return $this;
    }

    /**
     * Create a RSA private key
     *
     * @return string
     */
    public function createPrivateKey()
    {
        $rsa = new RSA();
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);

        return $rsa->createKey($this->getPrivateKeySize())['privatekey'];
    }
}
