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
}
