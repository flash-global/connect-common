<?php

namespace Fei\Service\Connect\Common\Message;

/**
 * Interface MessageAwareInterface
 *
 * @package Fei\Service\Connect\Common\Message
 */
interface MessageAwareInterface
{
    /**
     * Set Message
     *
     * @param MessageInterface $message
     */
    public function setMessage(MessageInterface $message);

    /**
     * Get Message
     *
     * @return MessageInterface
     */
    public function getMessage();
}
