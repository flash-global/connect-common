<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class RegisterMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class RegisterMessage implements MessageInterface
{
    /**
     * @var
     */
    protected $entityID;

    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $acs;

    /**
     * @var
     */
    protected $logout;

    /**
     * @return mixed
     */
    public function getEntityID()
    {
        return $this->entityID;
    }

    /**
     * @param mixed $entityID
     * @return RegisterMessage
     */
    public function setEntityID($entityID)
    {
        $this->entityID = $entityID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return RegisterMessage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcs()
    {
        return $this->acs;
    }

    /**
     * @param mixed $acs
     * @return RegisterMessage
     */
    public function setAcs($acs)
    {
        $this->acs = $acs;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogout()
    {
        return $this->logout;
    }

    /**
     * @param mixed $logout
     * @return RegisterMessage
     */
    public function setLogout($logout)
    {
        $this->logout = $logout;
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
            'entityID' => $this->getEntityID(),
            'name' => $this->getName(),
            'acs' => $this->getAcs(),
            'logout' => $this->getLogout()
        ];
    }
}
