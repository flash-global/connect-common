<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Admin\Message\RegenMessage;
use Fei\Service\Connect\Common\Admin\Message\RegisterMessage;
use Fei\Service\Connect\Common\Admin\Message\SubscribeMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class SubscribeMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class SubscribeMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->testOneAccessors('entityID', 'http://127.0.0.1:8080');
        $this->testOneAccessors('name', 'test');
        $this->testOneAccessors('adminPathInfo', 'http://127.0.0.1:8080/admin.php');
    }

    public function testJsonSerialize()
    {
        $message = (new SubscribeMessage())
            ->setEntityID('http://127.0.0.1:8080')
            ->setName('test')
            ->setAdminPathInfo('http://127.0.0.1:8080/admin.php');

        $this->assertEquals([
            'entityID' => 'http://127.0.0.1:8080',
            'name' => 'test',
            'adminPathInfo' => 'http://127.0.0.1:8080/admin.php'
        ], $message->jsonSerialize());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new SubscribeMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
