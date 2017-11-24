<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Admin\Message\RegenMessage;
use Fei\Service\Connect\Common\Admin\Message\RegisterMessage;
use Fei\Service\Connect\Common\Admin\Message\SpEntityConfigurationMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class SpEntityConfigurationMessageTest
 * @package Test\Fei\Service\Connect\Common\Message
 */
class SpEntityConfigurationMessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->testOneAccessors('id', 25);
        $this->testOneAccessors('xml', '<xml></xml>');
        $this->testOneAccessors('acs', 'http://127.0.0.1:8080/acs');
        $this->testOneAccessors('logout', 'http://127.0.0.1:8080/logout');
    }

    public function testJsonSerialize()
    {
        $message = (new SpEntityConfigurationMessage())
            ->setId(25)
            ->setXml('<xml></xml>')
            ->setAcs('http://127.0.0.1:8080/acs')
            ->setLogout('http://127.0.0.1:8080/logout');

        $this->assertEquals([
            'id' => 25,
            'xml' => '<xml></xml>',
            'acs' => 'http://127.0.0.1:8080/acs',
            'logout' => 'http://127.0.0.1:8080/logout'
        ], $message->jsonSerialize());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $auditEventTest = new SpEntityConfigurationMessage();
        $auditEventTest->$setter($expected);
        $this->assertEquals($auditEventTest->$getter(), $expected);
        $this->assertAttributeEquals($auditEventTest->$getter(), $name, $auditEventTest);
    }
}
