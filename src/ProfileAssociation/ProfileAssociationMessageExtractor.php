<?php

namespace Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Cryptography\CryptographyAwareTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Exception\ProfileAssociationException;
use Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor\MessageExtractorAwareTrait;
use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageInterface;
use Psr\Http\Message\MessageInterface as HttpMessageInterface;

/**
 * Class ProfileAssociationResponseFactory
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationMessageExtractor
{
    use CryptographyAwareTrait, MessageExtractorAwareTrait;

    /**
     * Extract a MessageInterface instance from a response
     *
     * @param HttpMessageInterface $httpMessage
     * @param mixed                $privateKey
     *
     * @return MessageInterface
     *
     * @throws ProfileAssociationException
     */
    public function extract(HttpMessageInterface $httpMessage, $privateKey) : MessageInterface
    {
        $httpMessage->getBody()->rewind();
        $message = $httpMessage->getBody()->getContents();

        $message = $this->getCryptography()->decryptMessage(base64_decode($message), $privateKey);

        return $this->getMessageExtractor()->extract(\json_decode($message, true));
    }
}
