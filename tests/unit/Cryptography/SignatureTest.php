<?php

namespace Test\Fei\Service\Connect\Common\Cryptography;

use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\Signature;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use PHPUnit\Framework\TestCase;

/**
 * Class SignatureTest
 *
 * @package Test\Fei\Service\Connect\Common\Cryptography
 */
class SignatureTest extends TestCase
{
    public function testSigning()
    {
        $privateKey = (new RsaKeyGen())->createPrivateKey();
        $cert = (new X509CertificateGen())->createX509Certificate($privateKey);

        $signature = (new Signature())->sign('test', $privateKey);

        $this->assertTrue((new Signature())->verify('test', $signature, $cert));
    }
}
