<?php

namespace Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\CryptographyAwareTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageAwareTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageDecorator;
use Zend\Diactoros\Stream;
use Psr\Http\Message\MessageInterface;

/**
 * Trait BodyBuilderTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
trait BodyBuilderTrait
{
    use CryptographyAwareTrait, MessageAwareTrait;

    /**
     * Build the response to send
     *
     * @param string $certificate
     *
     * @return MessageInterface
     */
    public function build($certificate)
    {
        $stream = new Stream('php://temp', 'wb+');

        $stream->write(
            base64_encode(
                $this->getCryptography()->encryptMessage(
                    json_encode(new MessageDecorator($this->getProfileAssociationMessage())),
                    $certificate
                )
            )
        );

        return $this->getHttpMessage()
            ->withAddedHeader('Content-Type', 'text/plain')
            ->withBody($stream);
    }

    /**
     * Return a MessageInterface instance
     *
     * @return MessageInterface
     */
    abstract public function getHttpMessage();
}
