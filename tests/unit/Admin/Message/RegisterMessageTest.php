<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Admin\Message\RegenMessage;
use Fei\Service\Connect\Common\Admin\Message\RegisterMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class RegisterMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class RegisterMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->testOneAccessors('entityID', 'http://127.0.0.1:8080');
        $this->testOneAccessors('name', 'test');
        $this->testOneAccessors('acs', 'http://127.0.0.1:8080/acs');
        $this->testOneAccessors('logout', 'http://127.0.0.1:8080/logout');
    }

    public function testJsonSerialize()
    {
        $message = (new RegisterMessage())
            ->setEntityID('http://127.0.0.1:8080')
            ->setName('test')
            ->setAcs('http://127.0.0.1:8080/acs')
            ->setLogout('http://127.0.0.1:8080/logout');

        $this->assertEquals([
            'entityID' => 'http://127.0.0.1:8080',
            'name' => 'test',
            'acs' => 'http://127.0.0.1:8080/acs',
            'logout' => 'http://127.0.0.1:8080/logout'
        ], $message->jsonSerialize());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new RegisterMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
