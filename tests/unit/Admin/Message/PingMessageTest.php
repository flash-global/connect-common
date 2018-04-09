<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class PingMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class PingMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->oneAccessors('available', true);
    }

    public function testJsonSerialize()
    {
        $message = (new PingMessage())
            ->setAvailable(true);

        $this->assertEquals(['available' => true], $message->jsonSerialize());
    }

    protected function oneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new PingMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
