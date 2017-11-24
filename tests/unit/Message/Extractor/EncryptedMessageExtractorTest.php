<?php

namespace Test\Fei\Service\Connect\Common\Message\Extractor;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use Fei\Service\Connect\Common\Message\Extractor\EncryptedMessageExtractor;
use Fei\Service\Connect\Common\Message\Extractor\MessageExtractor;
use Fei\Service\Connect\Common\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\ProfileAssociation\Message\ResponseMessage;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Stream;

/**
 * Class ProfileAssociationMessageExtractorTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class EncryptedMessageExtractorTest extends TestCase
{
    public function testExtract()
    {
        $extractor = new EncryptedMessageExtractor();

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $message = json_encode([
            'class' => ResponseMessage::class,
            'data' => ['role' => 'TEST']
        ]);

        $private = (new RsaKeyGen())->createPrivateKey();
        $certificate = (new X509CertificateGen())->createX509Certificate($private);

        $body = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->getMock();
        $body->expects($this->once())->method('rewind');
        $body->expects($this->once())
            ->method('getContents')
            ->willReturn(base64_encode((new Cryptography())
            ->encrypt($message, $certificate)));

        $response->expects($this->any())->method('getBody')->willReturn($body);

        $extractor->setMessageExtractor((new MessageExtractor())->setHydrator(new MessageHydrator()));

        $message = $extractor->extract($response, $private);

        $this->assertInstanceOf(ResponseMessage::class, $message);
    }
}
