<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\BodyBuilderTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\Cryptography;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface;
use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageInterface as ProfileAssociationMessageInterface;
use Zend\Diactoros\Response;

/**
 * Class BodyBuilderTraitTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class BodyBuilderTraitTest extends TestCase
{
    public function testResponseBodyIsBuild()
    {
        $message = $this->getMockBuilder(ProfileAssociationMessageInterface::class)->getMock();

        $message->expects($this->once())->method('jsonSerialize')->willReturn('message');

        $crypto = $this->getMockBuilder(Cryptography::class)->getMock();

        $crypto->expects($this->once())
            ->method('encryptMessage')
            ->with(json_encode(['class' => get_class($message), 'body' => 'message']), 'certificate')
            ->willReturn('message_encrypted');

        $instance = new class {
            use BodyBuilderTrait;

            public function getHttpMessage()
            {
                return new Response();
            }
        };
        $instance->setCryptography($crypto);
        $instance->setProfileAssociationMessage($message);

        $instance = $instance->build('certificate');
        $instance->getBody()->rewind();

        $this->assertEquals(base64_encode('message_encrypted'), $instance->getBody()->getContents());
        $this->assertEquals('text/plain', $instance->getHeaderLine('Content-Type'));
    }
}
