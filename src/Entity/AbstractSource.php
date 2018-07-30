<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\AbstractEntity;
use Fei\Service\Connect\Common\Transformer\ApplicationGroupMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\ApplicationMinimalTransformer;

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
     * @return ArrayCollection|Attribution[]
     */
    public function getAttributions()
    {
        return $this->attributions;
    }

    /**
     * @param ArrayCollection|Attribution[] $attributions
     * @return $this
     */
    public function setAttributions($attributions)
    {
        $this->attributions = $attributions;
        return $this;
    }

    public function toArray($mapped = false)
    {
        $array = parent::toArray($mapped);

        $applications = [];
        $applicationGroups = [];
        if (!is_null($this->getAttributions()) && !$this->getAttributions()->isEmpty()) {
            $applicationTransformer = new ApplicationMinimalTransformer();
            $applicationGroupTransformer = new ApplicationGroupMinimalTransformer();
            foreach ($this->getAttributions() as $attrib) {
                $target = $attrib->getTarget();
                $idrole = $attrib->getRole()->getId();
                if ($target instanceof Application) {
                    $application = $applicationTransformer->transform($target);
                    $application['idrole'] = $idrole;
                    $applications[] = $application;
                } elseif ($target instanceof ApplicationGroup) {
                    $applicationGroup = $applicationGroupTransformer->transform($target);
                    $applicationGroup['idrole'] = $idrole;
                    $applicationGroups[] = $applicationGroup;
                }
            }
        }

        $array['applications'] = $applications;
        $array['applicationGroups'] = $applicationGroups;

        return $array;
    }
}
