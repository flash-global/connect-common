<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Role
 *
 * @Entity
 * @Table(name="roles")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Role extends AbstractEntity
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
     * @Column(type="string", unique=true)
     *
     * @var string Role name
     */
    protected $role;

    /**
     * @Column(type="string")
     *
     * @var string Role name
     */
    protected $label;

    /**
     * @Column(type="boolean")
     *
     * @var bool
     */
    protected $userCreated = false;

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
     * Get Role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set Role
     *
     * @param string $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get Label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set Label
     *
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get UserCreated
     *
     * @return bool
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }

    /**
     * Set UserCreated
     *
     * @param bool $userCreated
     *
     * @return $this
     */
    public function setUserCreated($userCreated)
    {
        $this->userCreated = $userCreated;

        return $this;
    }

    /**
     * Get the Role localUsername
     *
     * @return null|string
     */
    public function fetchLocalUsername()
    {
        $localUsername = null;

        $roleParts = explode(':', $this->getRole());
        if (count($roleParts) === 3) {
            $localUsername = $roleParts[2];
        }

        return $localUsername;
    }
}
