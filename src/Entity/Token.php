<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Token
 *
 * @Entity
 * @Table(
 *     name="tokens",
 *     uniqueConstraints={
 *         @UniqueConstraint(name="token_unique", columns={ "user_id", "token" })
 *     }
 * )
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Token extends AbstractEntity
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
     * @Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $token;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", onDelete="CASCADE", nullable=true)
     *
     * @var User
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="Application")
     * @JoinColumn(name="application_id", onDelete="CASCADE", nullable=true)
     *
     * @var Application
     */
    protected $application;

    /**
     * @Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $expiration;

    /**
     * @ManyToOne(targetEntity="Attribution")
     * @JoinColumn(name="attribution_id", nullable=true)
     *
     * @var Attribution
     */
    protected $attribution;

    /**
     * Token constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
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
     * Get Token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set Token
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

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
     * Get Expiration
     *
     * @return \DateTime
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Set Expiration
     *
     * @param \DateTime $expiration
     *
     * @return $this
     */
    public function setExpiration(\DateTime $expiration)
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * Get Attribution
     *
     * @return Attribution|null
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * Set Attribution
     *
     * @param Attribution|null $attribution
     *
     * @return $this
     */
    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
        return $this;
    }
}
