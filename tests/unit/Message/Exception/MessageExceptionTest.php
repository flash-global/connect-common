<?php

namespace Test\Fei\Service\Connect\Common\Message\Exception;

use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use Fei\Service\Connect\Common\Message\Exception\MessageException;
use Fei\Service\Connect\Common\Message\ErrorMessage;
use Fei\Service\Connect\Common\Message\Http\MessageResponse;
use PHPUnit\Framework\TestCase;

class MessageExceptionTest extends TestCase
{
    public function testCertificateAccessors()
    {
        $exception = new MessageException();

        $exception->setCertificate('TEST');

        $this->assertEquals('TEST', $exception->getCertificate());
        $this->assertAttributeEquals($exception->getCertificate(), 'certificate', $exception);
    }

    public function testGetResponse()
    {
        $exception = new MessageException('message test', 404);

        /** @var MessageResponse $response */
        $response = $exception->getResponse();

        $this->assertInstanceOf(MessageResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertInstanceOf(ErrorMessage::class, $response->getMessage());
        $this->assertEquals('message test', $response->getMessage()->getError());
    }

    public function testGetCryptedResponse()
    {
        $exception = new MessageException('message test', 0);

        $exception->setCertificate(
            (new X509CertificateGen())->createX509Certificate((new RsaKeyGen())->createPrivateKey())
        );

        /** @var MessageResponse $response */
        $response = $exception->getResponse();

        $this->assertInstanceOf(MessageResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertInstanceOf(ErrorMessage::class, $response->getMessage());
        $this->assertEquals('message test', $response->getMessage()->getError());
    }
}
