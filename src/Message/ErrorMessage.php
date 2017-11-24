<?php

namespace Fei\Service\Connect\Common\Message;

/**
 * Class ErrorMessage
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class ErrorMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected $error;

    /**
     * Get Error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set Error
     *
     * @param string $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

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
        return ['error' => $this->getError()];
    }
}
