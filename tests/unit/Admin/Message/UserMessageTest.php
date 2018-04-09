<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Admin\Message\UserMessage;
use Fei\Service\Connect\Common\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class UserMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->oneAccessors('user', true);
    }

    public function testJsonSerialize()
    {
        $user = new User();
        $message = (new UserMessage())
            ->setUser($user);

        $this->assertEquals(['user' => $user->toArray()], $message->jsonSerialize());
    }

    protected function oneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new UserMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
