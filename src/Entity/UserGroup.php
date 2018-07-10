<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fei\Service\Connect\Common\Transformer\ApplicationGroupMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\ApplicationMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\UserMinimalTransformer;

/**
 * Class UserGroup
 *
 * @Entity
 * @Table(name="user_groups")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class UserGroup extends AbstractSource
{
    /**
     * @Column(type="string", unique=true)
     *
     * @var string UserGroup name
     */
    protected $name;

    /**
     * Many Groups have Many Users.
     *
     * @ManyToMany(targetEntity="User", mappedBy="userGroups")
     *
     * @var Collection|User[]
     */
    protected $users;

    /**
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="default_role_id", onDelete="RESTRICT", nullable=false)
     *
     * @var Role
     */
    protected $defaultRole;

    /**
     * @OneToMany(targetEntity="Attribution", mappedBy="source", cascade={"all"})
     *
     * @var ArrayCollection|Attribution[];
     */
    protected $attributions;

    /**
     * UserGroup constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->setUsers(new ArrayCollection());

        parent::__construct($data);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return UserGroup
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Users
     *
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * Set Users
     *
     * @param Collection $users
     *
     * @return $this
     */
    public function setUsers(Collection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Add users
     *
     * @param User ...$users
     *
     * @return $this
     */
    public function addUsers(User ...$users)
    {
        foreach ($users as $user) {
            $this->getUsers()->add($user);
        }

        return $this;
    }

    /**
     * Remove users
     *
     * @param User ...$users
     *
     * @return $this
     */
    public function removeUsers(User ...$users)
    {
        foreach ($users as $user) {
            $this->getUsers()->removeElement($user);
        }

        return $this;
    }

    /**
     * Get DefaultRole
     *
     * @return Role
     */
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }

    /**
     * Set DefaultRole
     *
     * @param Role $defaultRole
     *
     * @return $this
     */
    public function setDefaultRole(Role $defaultRole)
    {
        $this->defaultRole = $defaultRole;

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
     * @return UserGroup
     */
    public function setAttributions($attributions)
    {
        $this->attributions = $attributions;
        return $this;
    }



    /**
     * @param bool $mapped
     * @return array
     */
    public function toArray($mapped = false)
    {
        $array = parent::toArray($mapped);

        $users = [];
        if (!$this->getUsers()->isEmpty()) {
            $userTransformer = new UserMinimalTransformer();
            foreach ($this->getUsers() as $user) {
                $users[] = $userTransformer->transform($user);
            }
        }

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

        $array['users'] = $users;
        $array['applications'] = $applications;
        $array['applicationGroups'] = $applicationGroups;

        return $array;
    }
}
