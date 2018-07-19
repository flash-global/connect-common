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
 *         @UniqueConstraint(name="attribution_unique", columns={ "source_id", "target_id", "role_id" })
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
     * @ManyToOne(targetEntity="AbstractSource")
     * @JoinColumn(name="source_id", onDelete="CASCADE", nullable=false)
     *
     * @var AbstractSource $source
     */
    protected $source;

    /**
     * @ManyToOne(targetEntity="AbstractTarget")
     * @JoinColumn(name="target_id", onDelete="CASCADE", nullable=false)
     *
     * @var AbstractTarget $target
     */
    protected $target;

    /**
     * @ManyToOne(targetEntity="Role")
     * @JoinColumn(name="role_id", onDelete="CASCADE", nullable=false)
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
     * @return AbstractSource
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param AbstractSource $source
     * @return Attribution
     */
    public function setSource(AbstractSource $source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return AbstractTarget
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param AbstractTarget $target
     * @return Attribution
     */
    public function setTarget(AbstractTarget $target)
    {
        $this->target = $target;

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

        $data['source'] = !empty($data['user']) ? $data['user']->toArray() : null;
        $data['target'] = !empty($data['application']) ? $data['application']->toArray() : null;
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
            $data['target'] = new Application($data['application']);
        }

        if (!empty($data['application_group'])) {
            $data['target'] = new ApplicationGroup($data['application_group']);
        }

        if (!empty($data['user'])) {
            $data['source'] = new User($data['user']);
            $data['source']->getAttributions()->add($this);
        }

        return parent::hydrate($data);
    }

    /**
     * Get the Attribution Role localUsername
     *
     * @return null|string
     */
    public function fetchLocalUsername()
    {
        $localUsername = null;

        $role = $this->getRole();
        if ($role) {
            $roleParts = explode(':', $role->getRole());
            if (count($roleParts) === 3) {
                $localUsername = $roleParts[2];
            }
        }

        return $localUsername;
    }
}
