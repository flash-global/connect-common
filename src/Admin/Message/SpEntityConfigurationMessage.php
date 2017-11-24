<?php

namespace Fei\Service\Connect\Common\Admin\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

/**
 * Class SpEntityConfigurationMessage
 *
 * @package Fei\Service\Connect\Common\Admin\Message
 */
class SpEntityConfigurationMessage implements MessageInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $xml;

    /**
     * @var
     */
    protected $acs = '';

    /**
     * @var
     */
    protected $logout = '';

    /**
     * Get Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Xml
     *
     * @return string
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * Set Xml
     *
     * @param string $xml
     *
     * @return $this
     */
    public function setXml($xml)
    {
        $this->xml = $xml;

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
     * @return SpEntityConfigurationMessage
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
     * @return SpEntityConfigurationMessage
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
            'id' => $this->getId(),
            'xml' => $this->getXml(),
            'acs' => $this->getAcs(),
            'logout' => $this->getLogout()
        ];
    }
}
