<?php

namespace Fei\Service\Connect\Common\Entity;


use Fei\Entity\AbstractEntity;

/**
 * Class ForeignServiceId
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class ForeignServiceId extends AbstractEntity
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $id
     */
    protected $id;

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
     * @return ForeignServiceId
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

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
     * @return ForeignServiceId
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
