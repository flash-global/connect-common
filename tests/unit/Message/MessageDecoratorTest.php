<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Message\ErrorMessage;
use Fei\Service\Connect\Common\Message\MessageDecorator;
use Fei\Service\Connect\Common\Message\MessageInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageDecoratorTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class MessageDecoratorTest extends TestCase
{
    public function testMessageAccessors()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $decorator = new MessageDecorator($message);

        $this->assertEquals($message, $decorator->getMessage());
        $this->assertAttributeEquals($decorator->getMessage(), 'message', $decorator);
    }

    public function testJsonSerialize()
    {
        $message = new ErrorMessage();
        $message->setError('error!');

        $decorator = new MessageDecorator($message);

        $this->assertEquals(
            [
                'class' => 'Fei\Service\Connect\Common\Message\ErrorMessage',
                'data' => ['error' => 'error!']
            ],
            $decorator->jsonSerialize()
        );
    }
}
