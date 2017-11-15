<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor;

use Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor\MessageExtractor;
use Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor\MessageExtractorAwareTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageExtractorAwareTraitTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor
 */
class MessageExtractorAwareTraitTest extends TestCase
{
    public function testMessageExtractorAccessor()
    {
        $extractor = $this->getMockBuilder(MessageExtractor::class)->getMock();

        $instance = new class {
            use MessageExtractorAwareTrait;
        };

        $instance->setMessageExtractor($extractor);

        $this->assertEquals($extractor, $instance->getMessageExtractor());
        $this->assertAttributeEquals($extractor, 'messageExtractor', $instance);
    }
}
