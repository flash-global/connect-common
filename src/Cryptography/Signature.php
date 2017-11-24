<?php

namespace Fei\Service\Connect\Common\Cryptography;

use phpseclib\Crypt\RSA;
use phpseclib\File\X509;

/**
 * Class Signature
 *
 * @package Fei\Service\Connect\Common\Cryptography
 */
class Signature
{
    /**
     * Sign contents
     *
     * @param string $contents
     * @param string $privateKey
     *
     * @return string
     */
    public function sign($contents, $privateKey)
    {
        $rsa = new RSA();
        $rsa->loadKey($privateKey);

        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        return $rsa->sign($contents);
    }

    /**
     * Verify signature
     *
     * @param string $contents
     * @param string $signature
     * @param string $certificate X.509 certificate
     *
     * @return bool
     */
    public function verify($contents, $signature, $certificate)
    {
        $x509 = new X509();
        $x509->loadX509($certificate);

        $rsa = new RSA();
        $rsa->loadKey($x509->getPublicKey());

        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        return $rsa->verify($contents, $signature);
    }
}
