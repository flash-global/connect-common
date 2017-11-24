<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class ResistrationMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class SubscribeMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected $entityID;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $adminPathInfo;

    /**
     * Get EntityID
     *
     * @return string
     */
    public function getEntityID()
    {
        return $this->entityID;
    }

    /**
     * Set EntityID
     *
     * @param string $entityID
     *
     * @return $this
     */
    public function setEntityID($entityID)
    {
        $this->entityID = $entityID;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get AdminPathInfo
     *
     * @return string
     */
    public function getAdminPathInfo()
    {
        return $this->adminPathInfo;
    }

    /**
     * Set AdminPathInfo
     *
     * @param string $adminPathInfo
     *
     * @return $this
     */
    public function setAdminPathInfo($adminPathInfo)
    {
        $this->adminPathInfo = $adminPathInfo;

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
            'adminPathInfo' => $this->getAdminPathInfo()
        ];
    }
}
