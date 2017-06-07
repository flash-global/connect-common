<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Message;

use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageAwareTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Message\ResponseMessageInterface;
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
        $message = $this->getMockBuilder(ResponseMessageInterface::class)->getMock();

        $instance = new class {
            use MessageAwareTrait;
        };

        $instance->setProfileAssociationMessage($message);

        $this->assertEquals($message, $instance->getProfileAssociationMessage());
        $this->assertAttributeEquals($message, 'profileAssociationMessage', $instance);
    }
}
