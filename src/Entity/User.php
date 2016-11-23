<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fei\Entity\AbstractEntity;

/**
 * Class User
 *
 * @Entity
 * @Table(name="users")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class User extends AbstractEntity
{
    const USER_NAME = 'user_name';
    const REGISTER_TOKEN = 'register_token';
    const STATUS = 'status';

    const STATUS_PENDING = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_SUSPENDED = 3;
    const STATUS_DELETED = 0;

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @Column(type="string", unique=true)
     *
     * @var string
     */
    protected $userName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $firstName;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $lastName;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $email;

    /**
     * @Column(type="integer")
     *
     * @var int
     */
    protected $status = self::STATUS_PENDING;

    /**
     * @Column(type="guid", nullable=true)
     *
     * @var string
     */
    protected $registerToken;

    /**
     * @OneToMany(targetEntity="Attribution", mappedBy="user", cascade={"all"})
     *
     * @var ArrayCollection;
     */
    protected $attributions;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->attributions = new ArrayCollection();
        $this->setCreatedAt(new \DateTime());

        parent::__construct($data);
    }

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
     * Get UserName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set UserName
     *
     * @param string $userName
     *
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param \DateTime|string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt instanceof \DateTime ? $createdAt : new \DateTime($createdAt);

        return $this;
    }

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get FirstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set FirstName
     *
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get LastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set LastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get RegisterToken
     *
     * @return string
     */
    public function getRegisterToken()
    {
        return $this->registerToken;
    }

    /**
     * Set RegisterToken
     *
     * @param string $registerToken
     *
     * @return $this
     */
    public function setRegisterToken($registerToken)
    {
        $this->registerToken = $registerToken;

        return $this;
    }

    /**
     * Get Attributions
     *
     * @return ArrayCollection
     */
    public function getAttributions()
    {
        return $this->attributions;
    }

    /**
     * Set Attributions
     *
     * @param ArrayCollection $attributions
     *
     * @return $this
     */
    public function setAttributions(ArrayCollection $attributions)
    {
        $this->attributions->clear();

        /** @var Attribution $attr */
        foreach ($attributions as $attr) {
            $attr->setUser($this);
            $this->attributions->add($attr);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray($mapped = false)
    {
        $data = parent::toArray($mapped);

        $attributions = [];

        /** @var Attribution $attribution */
        foreach ($data['attributions'] as $attribution) {
            $attributions[] = [
                'id' => $attribution->getId(),
                'application' => $attribution->getApplication()->toArray(),
                'role' => $attribution->getRole()->toArray()
            ];
        }

        $data['attributions'] = $attributions;

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($data)
    {
        $attributions = new ArrayCollection();

        if (!empty($data['attributions'])) {
            foreach ($data['attributions'] as $attribution) {
                $attributions->add(
                    (new Attribution($attribution))
                        ->setUser($this)
                );
            }
        }

        $data['attributions'] = $attributions;

        return parent::hydrate($data);
    }
}
