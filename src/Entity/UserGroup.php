<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fei\Service\Connect\Common\Transformer\ApplicationGroupMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\ApplicationMinimalTransformer;

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
     * @param bool $mapped
     * @return array
     */
    public function toArray($mapped = false)
    {
        $array = parent::toArray($mapped);

        $applicationTransformer = new ApplicationMinimalTransformer();
        $applicationGroupTransformer = new ApplicationGroupMinimalTransformer();

        $serializeAttribution =
            function (Attribution $attribution) use ($applicationTransformer, $applicationGroupTransformer) {
                $item = [
                    'id' => $attribution->getId(),
                    'role' => $attribution->getRole()->toArray()
                ];

                $target = $attribution->getTarget();

                if ($target instanceof ApplicationGroup) {
                    $item['application_group'] = $applicationGroupTransformer->transform($target);
                } elseif ($target instanceof Application) {
                    $item['application'] = $applicationTransformer->transform($target);
                }

                return $item;
            };

        $array['attributions'] = array_map($serializeAttribution, $array['attributions']->toArray());

        $array['default_role'] = $array['default_role'] instanceof Role ? $array['default_role']->toArray() : null;

        return $array;
    }

    /**
     * {@inherited}
     */
    public function hydrate($data)
    {
        $attributions = new ArrayCollection();

        if (!empty($data['attributions'])) {
            foreach ($data['attributions'] as $attribution) {
                $attributions->add(
                    (new Attribution($attribution))->setSource($this)
                );
            }
        }

        if (!empty($data['default_role'])) {
            $data['default_role'] = new Role($data['default_role']);
        }

        $data['attributions'] = $attributions;

        return parent::hydrate($data);
    }
}
