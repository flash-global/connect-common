<?php

namespace Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Message\MessageAwareTrait;
use Fei\Service\Connect\Common\Message\MessageDecorator;
use Laminas\Diactoros\Stream;
use Psr\Http\Message\MessageInterface;

/**
 * Trait BodyBuilderTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
trait BodyBuilderTrait
{
    use MessageAwareTrait;

    /**
     * Build the encrypted response to send
     *
     * @param string $certificate
     *
     * @return MessageInterface
     */
    public function buildEncrypted($certificate)
    {
        $stream = new Stream('php://temp', 'wb+');

        $content = base64_encode(
            (new Cryptography())->encrypt(
                json_encode(new MessageDecorator($this->getMessage())),
                $certificate
            )
        );

        $stream->write($content);

        return $this->getHttpMessage()
            ->withAddedHeader('Content-Type', 'text/plain')
            ->withBody($stream);
    }

    /**
     * Build the response to send
     *
     * @return MessageInterface
     */
    public function build()
    {
        $stream = new Stream('php://temp', 'wb+');


        $stream->write(json_encode(new MessageDecorator($this->getMessage())));

        return $this->getHttpMessage()
            ->withAddedHeader('Content-Type', 'application/json')
            ->withBody($stream);
    }

    /**
     * Return a MessageInterface instance
     *
     * @return MessageInterface
     */
    abstract public function getHttpMessage();
}
