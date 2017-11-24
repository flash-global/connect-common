<?php

namespace Test\Fei\Service\Connect\Common\Cryptography;

use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use PHPUnit\Framework\TestCase;

/**
 * Class KeyGenTest
 *
 * @package Test\Fei\Service\Connect\Common\Crypt
 */
class RsaKeyGenTest extends TestCase
{
    public function testPrivateKeySizeAccessors()
    {
        $gen = new RsaKeyGen();

        $this->assertEquals(1024, $gen->getPrivateKeySize());

        $gen->setPrivateKeySize(2048);

        $this->assertEquals(2048, $gen->getPrivateKeySize());
        $this->assertAttributeEquals(2048, 'privateKeySize', $gen);
    }

    public function testCreatePrivateKey()
    {
        $gen = new RsaKeyGen();

        $this->assertRegExp(
            '/^(-----BEGIN RSA PRIVATE KEY-----)(\v.*)+(-----END RSA PRIVATE KEY-----)$/',
            $gen->createPrivateKey()
        );
    }
}
