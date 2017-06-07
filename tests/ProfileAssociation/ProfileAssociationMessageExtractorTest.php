<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\Cryptography;
use Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor\MessageExtractor;
use Fei\Service\Connect\Common\ProfileAssociation\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\ProfileAssociation\Message\ResponseMessage;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationMessageExtractor;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Stream;

/**
 * Class ProfileAssociationMessageExtractorTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationMessageExtractorTest extends TestCase
{
    public function testExtract()
    {
        $extractor = new ProfileAssociationMessageExtractor();

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $message = json_encode([
            'class' => ResponseMessage::class,
            'body' => ['role' => 'TEST']
        ]);

        $message = (new Cryptography())->encryptMessage($message, 'file://' . __DIR__ . '/../data/idp.crt');

        $body = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->getMock();
        $body->expects($this->once())->method('rewind');
        $body->expects($this->once())->method('getContents')->willReturn(base64_encode($message));

        $response->expects($this->any())->method('getBody')->willReturn($body);

        $extractor->setCryptography(new Cryptography());
        $extractor->setMessageExtractor((new MessageExtractor())->setHydrator(new MessageHydrator()));

        $message = $extractor->extract($response, 'file://' . __DIR__ . '/../data/idp.pem');

        $this->assertInstanceOf(ResponseMessage::class, $message);
    }
}
