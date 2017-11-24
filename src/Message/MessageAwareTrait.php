<?php

namespace Fei\Service\Connect\Common\Message;

/**
 * Trait MessageAwareTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
trait MessageAwareTrait
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * Get Message
     *
     * @return MessageInterface
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param MessageInterface $message
     *
     * @return $this
     */
    public function setMessage(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }
}
