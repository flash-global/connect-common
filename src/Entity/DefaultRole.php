<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class DefaultRole
 *
 * @Entity
 * @Table(name="default_roles")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class DefaultRole extends AbstractEntity
{
    /**
     * @Id
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", onDelete="CASCADE", nullable=false)
     *
     * @var User
     */
    protected $user;

    /**
     * @Id
     *
     * @ManyToOne(targetEntity="Application")
     * @JoinColumn(name="application_id", onDelete="CASCADE", nullable=false)
     *
     * @var Application
     */
    protected $application;

    /**
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="role_id", onDelete="CASCADE", nullable=false)
     *
     * @var Role
     */
    protected $role;

    /**
     * Get User
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get Application
     *
     * @return Application
     */
    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * Set Application
     *
     * @param Application $application
     *
     * @return $this
     */
    public function setApplication(Application $application)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get Role
     *
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * Set Role
     *
     * @param Role $role
     *
     * @return $this
     */
    public function setRole(Role $role)
    {
        $this->role = $role;

        return $this;
    }
}
