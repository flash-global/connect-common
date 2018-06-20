<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\AbstractEntity;

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
     * @var string UserGroup name
     */
    protected $name;

    /**
     * @Column(type="json_array")
     * @var array
     */
    protected $contexts = [];

    /**
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="User")
     * @JoinTable(name="user_groups_user",
     *      joinColumns={@JoinColumn(name="user_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    protected $users;

    /**
     * ApplicationGroup constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();

        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UserGroup
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return array
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * @param array $contexts
     * @return UserGroup
     */
    public function setContexts($contexts, $erase = true)
    {
        if (!$erase) {
            $this->contexts = array_merge($this->contexts, $contexts);
        } else {
            $this->contexts = $contexts;
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addContext($key, $value)
    {
        $this->contexts[$key] = $value;
    }

    /**
     * @param $key
     * @return null
     */
    public function retrieveContext($key)
    {
        return isset($this->contexts[$key]) ? $this->contexts[$key] : null;
    }
}
