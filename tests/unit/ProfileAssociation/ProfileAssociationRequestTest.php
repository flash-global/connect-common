<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Message\RequestMessageInterface;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationRequestTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationRequestTest extends TestCase
{
    public function testRequestIsBuild()
    {
        $message = $this->getMockBuilder(RequestMessageInterface::class)->getMock();

        $request = new ProfileAssociationRequest($message);

        $this->assertEquals('POST', $request->getMethod());
    }

    public function testGetHttpMessageImplementation()
    {
        $message = $this->getMockBuilder(RequestMessageInterface::class)->getMock();

        $request = new ProfileAssociationRequest($message);

        $this->assertEquals($request, $request->getHttpMessage());
    }
}
