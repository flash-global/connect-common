<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class AbstractSource
 *
 * @Entity
 * @InheritanceType("JOINED")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
abstract class AbstractSource extends AbstractEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * Get Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param mixed $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}
