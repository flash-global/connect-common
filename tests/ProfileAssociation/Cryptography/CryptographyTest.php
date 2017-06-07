<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Cryptography;

use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\Cryptography;
use PHPUnit\Framework\TestCase;

/**
 * Class CryptographyTest
 *
 * @package Test\Fei\Service\Connect\Common\Message
 */
class CryptographyTest extends TestCase
{
    /**
     * @dataProvider dataForEncryptionDecryption
     *
     * @param string $message
     * @param string $certificate
     * @param string $key
     */
    public function testMessageIsEncrypted($message, $certificate, $key)
    {
        $crypt = new Cryptography();

        $this->assertEquals($message, $crypt->decryptMessage($crypt->encryptMessage($message, $certificate), $key));
    }

    public function testEncryptionFailWithBadCertificate()
    {
        $crypt = new Cryptography();

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Certificate isn\'t valid');

        $crypt->encryptMessage('test', 'notacertificate');
    }

    public function testDecryptionFailWithBadKey()
    {
        $crypt = new Cryptography();

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Private key isn\'t valid');

        $crypt->decryptMessage('test', 'notakey');
    }

    public function dataForEncryptionDecryption()
    {
        return [
            ['test', 'file://' . __DIR__ . '/../../data/idp.crt', 'file://' . __DIR__ . '/../../data/idp.pem']
        ];
    }
}
