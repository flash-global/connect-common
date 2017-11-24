<?php

namespace Test\Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Message\Http\MessageResponse;
use Fei\Service\Connect\Common\Message\MessageInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationResponseTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageResponseTest extends TestCase
{
    public function testMessageIsInitializedViaConstructor()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $response = new MessageResponse($message);

        $this->assertEquals($message, $response->getMessage());
    }

    public function testGetHttpMessageImplementation()
    {
        $message = $this->getMockBuilder(MessageInterface::class)->getMock();

        $response = new MessageResponse($message);

        $this->assertEquals($response, $response->getHttpMessage());
    }
}
