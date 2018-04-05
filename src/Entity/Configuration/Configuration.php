<?php

namespace Fei\Service\Connect\Common\Entity\Configuration;

use Fei\Entity\AbstractEntity;

/**
 * Class Attribution
 *
 * @Entity
 * @Table(name="configurations")
 *
 * @package Fei\Service\Connect\Common\Entity\Configuration
 */
class Configuration extends AbstractEntity
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", name="`key`", unique=true)
     */
    protected $key;

    /**
     * @var string
     *
     * @Column(type="text", name="`value`", nullable=true)
     */
    protected $value;

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get Key
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set Key
     *
     * @param mixed $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get Value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Value
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
