<?php

namespace Test\Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Message\MessageInterface;
use Fei\Service\Connect\Common\Message\Http\MessageRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationRequestTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageRequestTest extends TestCase
{
    public function testRequestIsBuild()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $request = new MessageRequest($message);

        $this->assertEquals('POST', $request->getMethod());
    }

    public function testGetHttpMessageImplementation()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $request = new MessageRequest($message);

        $this->assertEquals($request, $request->getHttpMessage());
    }
}
