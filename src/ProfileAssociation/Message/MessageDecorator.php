<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

/**
 * Class MessageDecorator
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class MessageDecorator implements MessageInterface
{
    /**
     * @var MessageInterface
     */
    protected $message;

    public function __construct(MessageInterface $message)
    {
        $this->setMessage($message);
    }

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

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'class' => get_class($this->getMessage()),
            'body' => $this->getMessage()->jsonSerialize()
        ];
    }
}
