<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Cryptography;

use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\Cryptography;
use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\CryptographyAwareTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class CryptographyAwateTraitTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class CryptographyAwareTraitTest extends TestCase
{
    public function testCryptographyAccessors()
    {
        $instance = new class {
            use CryptographyAwareTrait;
        };

        $crypto = new Cryptography();

        $instance->setCryptography($crypto);

        $this->assertEquals($crypto, $instance->getCryptography());
        $this->assertAttributeEquals($crypto, 'cryptography', $instance);
    }

    public function testCryptographyAccessorsAutoInstanced()
    {
        $instance = new class {
            use CryptographyAwareTrait;
        };

        $this->assertInstanceOf(Cryptography::class, $instance->getCryptography());
    }
}
