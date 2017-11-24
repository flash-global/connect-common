<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Message;

use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class UsernamePasswordMessageTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class UsernamePasswordMessageTest extends TestCase
{
    public function testUsernameAccessor()
    {
        $message = new UsernamePasswordMessage();

        $message->setUsername('test');

        $this->assertEquals('test', $message->getUsername());
        $this->assertAttributeEquals($message->getUsername(), 'username', $message);
    }

    public function testPasswordAccessor()
    {
        $message = new UsernamePasswordMessage();

        $message->setPassword('test');

        $this->assertEquals('test', $message->getPassword());
        $this->assertAttributeEquals($message->getPassword(), 'password', $message);
    }

    public function testRolesAccessor()
    {
        $message = new UsernamePasswordMessage();

        $message->setRoles(['test1', 'test2']);

        $this->assertEquals(['test1', 'test2'], $message->getRoles());
        $this->assertAttributeEquals($message->getRoles(), 'roles', $message);
    }

    public function testJsonSerialize()
    {
        $message = new UsernamePasswordMessage();

        $message->setUsername('test');
        $message->setPassword('pass');
        $message->setRoles(['test1', 'test2']);

        $this->assertEquals(
            ['username' => 'test', 'password' => 'pass', 'roles' => ['test1', 'test2']],
            $message->jsonSerialize()
        );
    }
}
