<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Profile
 *
 * @Entity
 * @Table(name="profiles")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Profile
{
    /**
     * @var int $id
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $profile
     * @Column(type="string", length=255)
     */
    protected $profile;

    /**
     * @var ProfileAssociation[] $profileAssociations
     * @ManyToMany(targetEntity="ProfileAssociation", mappedBy="profiles")
     */
    protected $profileAssociations;

    public function __construct(string $profile = "")
    {
        $this->profile = $profile;
        $this->profileAssociations = new ArrayCollection();
    }

    /**
     * GET Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * SET Id
     *
     * @param int $id
     * @return Profile
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get Profile
     *
     * @return string
     */
    public function getProfile(): string
    {
        return $this->profile;
    }

    /**
     * Set Profile
     *
     * @param string $profile
     * @return Profile
     */
    public function setProfile(string $profile): Profile
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * GET ProfileAssociations
     *
     * @return ProfileAssociation[]
     */
    public function getProfileAssociations(): ArrayCollection
    {
        return $this->profileAssociations;
    }

    /**
     * SET ProfileAssociations
     *
     * @param ProfileAssociation[] $profileAssociations
     * @return Profile
     */
    public function setProfileAssociations(ArrayCollection $profileAssociations)
    {
        $this->profileAssociations = $profileAssociations;
        return $this;
    }

    /**
     * @param ProfileAssociation ...$profileAssociations
     * @return Profile
     */
    public function addProfileAssociations(ProfileAssociation ...$profileAssociations): Profile
    {
        foreach ($profileAssociations as $profileAssociation) {
            $this->profileAssociations->add($profileAssociation);
        }

        return $this;
    }

    /**
     * @param ProfileAssociation ...$profileAssociations
     * @return Profile
     */
    public function removeProfileAssociations(ProfileAssociation ...$profileAssociations): Profile
    {
        foreach ($profileAssociations as $profileAssociation) {
            $this->profileAssociations->removeElement($profileAssociation);
        }

        return $this;
    }
}
