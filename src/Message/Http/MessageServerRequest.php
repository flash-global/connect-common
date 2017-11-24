<?php

namespace Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Message\Extractor\EncryptedMessageExtractor;
use Fei\Service\Connect\Common\Message\MessageInterface;
use Zend\Diactoros\ServerRequest;

/**
 * Class ProfileAssociationServerRequest
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageServerRequest extends ServerRequest
{
    /**
     * @var EncryptedMessageExtractor
     */
    protected $encryptedMessageExtractor;

    /**
     * Get EncryptedMessageExtractor
     *
     * @return EncryptedMessageExtractor
     */
    public function getEncryptedMessageExtractor()
    {
        return $this->encryptedMessageExtractor;
    }

    /**
     * Set EncryptedMessageExtractor
     *
     * @param EncryptedMessageExtractor $encryptedMessageExtractor
     *
     * @return $this
     */
    public function setEncryptedMessageExtractor($encryptedMessageExtractor)
    {
        $this->encryptedMessageExtractor = $encryptedMessageExtractor;

        return $this;
    }

    /**
     * Decrypt message from request contents body
     *
     * @param string $privateKey
     *
     * @return MessageInterface
     */
    public function extract($privateKey)
    {
        $message = $this->getEncryptedMessageExtractor()->extract($this, $privateKey);

        return $message;
    }
}
