<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\Message\Extractor\EncryptedMessageExtractor;
use Fei\Service\Connect\Common\Message\Http\MessageServerRequest;
use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationServerRequest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageServerRequestTest extends TestCase
{
    public function testProfileAssociationMessageExtractorAccessors()
    {
        $extractor = $this->getMockBuilder(EncryptedMessageExtractor::class)->getMock();

        $request = new MessageServerRequest();

        $request->setEncryptedMessageExtractor($extractor);

        $this->assertEquals($extractor, $request->getEncryptedMessageExtractor());
        $this->assertAttributeEquals(
            $request->getEncryptedMessageExtractor(),
            'encryptedMessageExtractor',
            $request
        );
    }

    public function testExtract()
    {
        $extractor = $this->getMockBuilder(EncryptedMessageExtractor::class)->getMock();
        $extractor->expects($this->once())->method('extract')->willReturn(new UsernamePasswordMessage());

        $request = new MessageServerRequest();

        $request->setEncryptedMessageExtractor($extractor);
        $request->extract('test');
    }
}
