<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Message\MessageAwareTrait;
use Fei\Service\Connect\Common\Message\MessageInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageAwareTraitTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageAwareTraitTest extends TestCase
{
    public function testMessageAccessors()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $instance = new Instance();

        $instance->setMessage($message);

        $this->assertEquals($message, $instance->getMessage());
        $this->assertAttributeEquals($message, 'message', $instance);
    }
}

class Instance
{
    use MessageAwareTrait;
}
