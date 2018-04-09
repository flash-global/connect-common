<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Admin\Message\RegenMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class RegenMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class RegenMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->oneAccessors('entityID', true);
    }

    public function testJsonSerialize()
    {
        $message = (new RegenMessage())
            ->setEntityID(true);

        $this->assertEquals(['entityID' => true], $message->jsonSerialize());
    }

    protected function oneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new RegenMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
