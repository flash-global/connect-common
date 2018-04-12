<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class PingMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class PingMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected $available;

    /**
     * @return string
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param string $available
     * @return PingMessage
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }




    /**
     * Specify data which should be serialized to JSON
     *
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since  5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'available' => $this->getAvailable(),
        ];
    }
}
