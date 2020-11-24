<?php

namespace Test\Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use Fei\Service\Connect\Common\Message\Http\BodyBuilderTrait;
use PHPUnit\Framework\TestCase;
use Fei\Service\Connect\Common\Message\MessageInterface;
use Laminas\Diactoros\Response;

/**
 * Class BodyBuilderTraitTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class BodyBuilderTraitTest extends TestCase
{
    public function testResponseBodyIsBuild()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();
        $message->expects($this->once())->method('jsonSerialize')->willReturn('message');

        $instance = new Instance();

        $instance->setMessage($message);

        $private = (new RsaKeyGen())->createPrivateKey();
        $certificate = (new X509CertificateGen())->createX509Certificate($private);

        $instance = $instance->buildEncrypted($certificate);
        $instance->getBody()->rewind();

        $this->assertEquals(
            'message',
            json_decode(
                (new Cryptography())->decrypt(base64_decode($instance->getBody()->getContents()), $private),
                true
            )['data']
        );
        $this->assertEquals('text/plain', $instance->getHeaderLine('Content-Type'));
    }
}

class Instance
{
    use BodyBuilderTrait;

    public function getHttpMessage()
    {
        return new Response();
    }
}
