<?php

namespace Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Message\MessageAwareTrait;
use Fei\Service\Connect\Common\Message\MessageDecorator;
use Zend\Diactoros\Stream;
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
     * Build the response to send
     *
     * @param string $certificate
     *
     * @return MessageInterface
     */
    public function build($certificate)
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
     * Return a MessageInterface instance
     *
     * @return MessageInterface
     */
    abstract public function getHttpMessage();
}
