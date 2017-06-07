<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Message;

use Fei\Service\Connect\Common\ProfileAssociation\Message\ResponseMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseMessageTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class ResponseMessageTest extends TestCase
{
    public function testRoleAccessor()
    {
        $message = new ResponseMessage();

        $message->setRole('TEST');

        $this->assertEquals('TEST', $message->getRole());
        $this->assertAttributeEquals($message->getRole(), 'role', $message);
    }

    public function testJsonSerialize()
    {
        $message = new ResponseMessage();

        $message->setRole('TEST');

        $this->assertEquals(['role' => 'TEST'], $message->jsonSerialize());
    }
}
