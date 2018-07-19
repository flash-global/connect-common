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
     * @var ArrayCollection|Attribution[];
     */
    protected $attributions;

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
     * Get Attributions
     *
     * @return ArrayCollection
     */
    public function getAttributions(): Collection
    {
        return $this->attributions;
    }

    /**
     * Set Attributions
     *
     * @param ArrayCollection $attributions
     *
     * @return $this
     */
    public function setAttributions(ArrayCollection $attributions)
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
