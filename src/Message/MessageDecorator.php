<?php

namespace Fei\Service\Connect\Common\Message;

/**
 * Class MessageDecorator
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class MessageDecorator implements MessageDecoratorInterface
{
    use MessageAwareTrait;

    /**
     * MessageDecorator constructor.
     *
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message = null)
    {
        if (!is_null($message)) {
            $this->setMessage($message);
        }
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
            'data' => $this->getMessage()->jsonSerialize()
        ];
    }
}
