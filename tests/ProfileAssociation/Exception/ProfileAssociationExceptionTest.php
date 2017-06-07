<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation\Cryptography;

use Fei\Service\Connect\Common\ProfileAssociation\Exception\ProfileAssociationException;
use Fei\Service\Connect\Common\ProfileAssociation\Message\ErrorMessage;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationResponse;
use PHPUnit\Framework\TestCase;

class ProfileAssociationExceptionTest extends TestCase
{
    public function testCertificateAccessors()
    {
        $exception = new ProfileAssociationException();

        $exception->setCertificate('TEST');

        $this->assertEquals('TEST', $exception->getCertificate());
        $this->assertAttributeEquals($exception->getCertificate(), 'certificate', $exception);
    }

    public function testGetResponse()
    {
        $exception = new ProfileAssociationException('message test', 404);

        /** @var ProfileAssociationResponse $response */
        $response = $exception->getResponse();

        $this->assertInstanceOf(ProfileAssociationResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertInstanceOf(ErrorMessage::class, $response->getProfileAssociationMessage());
        $this->assertEquals('message test', $response->getProfileAssociationMessage()->getError());
    }

    public function testGetCryptedResponse()
    {
        $exception = new ProfileAssociationException('message test', 0);

        $exception->setCertificate('file://' . __DIR__ . '/../../data/idp.crt');

        /** @var ProfileAssociationResponse $response */
        $response = $exception->getResponse();

        $this->assertInstanceOf(ProfileAssociationResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertInstanceOf(ErrorMessage::class, $response->getProfileAssociationMessage());
        $this->assertEquals('message test', $response->getProfileAssociationMessage()->getError());
    }
}
