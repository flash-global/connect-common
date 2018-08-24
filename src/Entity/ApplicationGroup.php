<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class ApplicationGroup
 *
 * @Entity
 * @Table(name="application_groups")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class ApplicationGroup extends AbstractTarget
{
    /**
     * @Column(type="string", unique=true)
     *
     * @var string ApplicationGroup name
     */
    protected $name;

    /**
     * Many Groups have Many Applications.
     * @ManyToMany(targetEntity="Application", mappedBy="applicationGroups")
     *
     * @var Collection|Application[]
     */
    protected $applications;

    /**
     * ApplicationGroup constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->setApplications(new ArrayCollection());

        parent::__construct($data);
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
     * Get Applications
     *
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    /**
     * Set Applications
     *
     * @param Collection|Application[] $applications
     *
     * @return $this
     */
    public function setApplications(Collection $applications)
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * Add applications
     *
     * @param Application ...$applications
     *
     * @return $this
     */
    public function addApplications(Application ...$applications)
    {
        foreach ($applications as $application) {
            $this->getApplications()->add($application);
        }

        return $this;
    }

    /**
     * Remove applications
     *
     * @param Application ...$applications
     *
     * @return $this
     */
    public function removeApplications(Application ...$applications)
    {
        foreach ($applications as $application) {
            $this->getApplications()->removeElement($application);
        }

        return $this;
    }
}
