<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @OneToMany(targetEntity="Attribution", mappedBy="source", cascade={"all"})
     *
     * @var Collection|Attribution[];
     */
    protected $attributions;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->setAttributions(new ArrayCollection());

        parent::__construct($data);
    }

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
    public function setId(int $id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set Attributions
     *
     * @param Collection $attributions
     *
     * @return $this
     */
    public function setAttributions(Collection $attributions)
    {
        if (!isset($this->attributions)) {
            $this->attributions = new ArrayCollection();
        }

        $this->getAttributions()->clear();

        /**
         * @var Attribution $attr
         */
        foreach ($attributions as $attr) {
            $attr->setSource($this);
            $this->getAttributions()->add($attr);
        }

        return $this;
    }

    /**
     * Get Attributions
     *
     * @return Collection|Attribution[]
     */
    public function getAttributions()
    {
        return $this->attributions;
    }

    /**
     * Add application groups
     *
     * @param Attribution[] $attributions
     *
     * @return $this
     */
    public function addAttributions(Attribution ...$attributions)
    {
        foreach ($attributions as $attribution) {
            $this->getAttributions()->add($attribution);
        }

        return $this;
    }
}
