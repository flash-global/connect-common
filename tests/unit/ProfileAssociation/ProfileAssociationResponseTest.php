<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Message\ResponseMessageInterface;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationResponseTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationResponseTest extends TestCase
{
    public function testMessageIsInitializedViaConstructor()
    {
        $message = $this->getMockBuilder(ResponseMessageInterface::class)->getMock();

        $response = new ProfileAssociationResponse($message);

        $this->assertEquals($message, $response->getProfileAssociationMessage());
    }

    public function testGetHttpMessageImplementation()
    {
        $message = $this->getMockBuilder(ResponseMessageInterface::class)->getMock();

        $response = new ProfileAssociationResponse($message);

        $this->assertEquals($response, $response->getHttpMessage());
    }
}
