<?php

namespace Fei\Service\Connect\Common\Message\Extractor;

use Fei\Service\Connect\Common\Cryptography\Cryptography;
use Fei\Service\Connect\Common\Message\MessageInterface;
use Psr\Http\Message\MessageInterface as HttpMessageInterface;

/**
 * Class EncryptedMessageExtractor
 *
 * @package Fei\Service\Connect\Common\Message\Extractor
 */
class EncryptedMessageExtractor
{
    use MessageExtractorAwareTrait;

    /**
     * Extract a MessageInterface instance from a response
     *
     * @param HttpMessageInterface $httpMessage
     * @param string               $privateKey
     *
     * @return MessageInterface
     */
    public function extract(HttpMessageInterface $httpMessage, $privateKey)
    {
        $httpMessage->getBody()->rewind();
        $message = $httpMessage->getBody()->getContents();

        $message = (new Cryptography())->decrypt(base64_decode($message), $privateKey);

        return $this->getMessageExtractor()->extract(\json_decode($message, true));
    }
}
