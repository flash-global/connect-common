<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class UserMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class UserMessage implements MessageInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Get User
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

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
            'user' => $this->getUser()->toArray()
        ];
    }
}
