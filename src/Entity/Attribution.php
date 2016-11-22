<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Attribution
 *
 * @Entity
 * @Table(
 *     name="attributions",
 *     uniqueConstraints={
 *         @UniqueConstraint(name="attribution_unique", columns={ "user_id", "application_id", "role_id" })
 *     }
 * )
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Attribution extends AbstractEntity
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
     * @ManyToOne(targetEntity="User", inversedBy="attributions")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @var User
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="Application")
     * @JoinColumn(name="application_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @var Application
     */
    protected $application;

    /**
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="role_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @var Role
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
     * Get User
     *
     * @return User
     */
    public function getUser()
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
    public function getApplication()
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
    public function getRole()
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

    /**
     * {@inheritdoc}
     */
    public function toArray($mapped = false)
    {
        $data = parent::toArray($mapped);

        $data['user'] = !empty($data['user']) ? $data['user']->toArray() : null;
        $data['application'] = !empty($data['application']) ? $data['application']->toArray() : null;
        $data['role'] = !empty($data['role']) ? $data['role']->toArray() : null;

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($data)
    {
        if (!empty($data['role'])) {
            $data['role'] = new Role($data['role']);
        }

        if (!empty($data['application'])) {
            $data['application'] = new Application($data['application']);
        }

        if (!empty($data['user'])) {
            $data['user'] = new User($data['user']);
            $data['user']->getAttributions()->add($this);
        }

        return parent::hydrate($data);
    }
}
