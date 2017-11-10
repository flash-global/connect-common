<?php

namespace Fei\Service\Connect\Common\Cryptography;

use phpseclib\Crypt\RSA;
use phpseclib\File\X509;

/**
 * Class Cryptography
 *
 * @package Fei\Service\Connect\Common\Cryptography
 */
class Cryptography
{
    /**
     * Encrypt contents with the recipient's X.509 certificate
     *
     * @param string $contents
     * @param string $certificate
     *
     * @return string
     */
    public function encrypt($contents, $certificate)
    {
        $x509 = new X509();
        $x509->loadX509($certificate);

        $rsa = new RSA();
        $rsa->loadKey($x509->getPublicKey());

        $rsa->setSignatureMode(RSA::ENCRYPTION_PKCS1);

        return $rsa->encrypt($contents);
    }

    /**
     * Decrypt encrypted contents with the recipient's private key
     *
     * @param string $encrypted
     * @param string $privateKey
     *
     * @return string
     */
    public function decrypt($encrypted, $privateKey)
    {
        $rsa = new RSA();
        $rsa->loadKey($privateKey);

        return $rsa->decrypt($encrypted);
    }
}
