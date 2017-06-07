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
        /*$message = (new UsernamePasswordMessage())
            ->setUsername('test')
            ->setPassword('pass')
            ->setRoles(['test1', 'test2']);

        $json = json_encode(new MessageDecorator($message));

        $crypt = new Cryptography();

        print_r(base64_encode($crypt->encryptMessage($json, 'file://' . __DIR__ . '/../data/sp.crt')));*/

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
