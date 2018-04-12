<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

/**
 * Class ResponseMessage
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class ResponseMessage implements ResponseMessageInterface
{
    /**
     * @var string
     */
    protected $role;

    /**
     * Return the roles to assign
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set Role
     *
     * @param string $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

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
        return ['role' => $this->getRole()];
    }
}
