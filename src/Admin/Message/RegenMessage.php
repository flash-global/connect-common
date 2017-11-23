<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class RegenMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class RegenMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected $entityID;

    /**
     * @return string
     */
    public function getEntityID()
    {
        return $this->entityID;
    }

    /**
     * @param string $entityID
     * @return RegenMessage
     */
    public function setEntityID($entityID)
    {
        $this->entityID = $entityID;
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
        ];
    }
}
