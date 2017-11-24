<?php

namespace Test\Fei\Service\Connect\Common\Cryptography;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use PHPUnit\Framework\TestCase;

/**
 * Class CryptographyTest
 *
 * @package Test\Fei\Service\Connect\Common\Cryptography
 */
class CryptographyTest extends TestCase
{
    public function testCrypt()
    {
        $privateKey = (new RsaKeyGen())->createPrivateKey();
        $cert = (new X509CertificateGen())->createX509Certificate($privateKey);

        $crypt = new Cryptography();

        $this->assertEquals('test', $crypt->decrypt($crypt->encrypt('test', $cert), $privateKey));
    }
}
