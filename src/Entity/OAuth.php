<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class OAuth
 *
 * @Entity
 * @Table(name="oauth")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class OAuth extends AbstractEntity
{
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 2;

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     *
     * @var string OAuth provider
     */
    protected $provider;

    /**
     * @Column(type="string")
     *
     * @var string OAuth name
     */
    protected $name;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $clientId;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * @Column(type="string")
     *
     * @var string
     */
    protected $redirectUri;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $hostedDomain;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $graphApiVersion;

    /**
     * @Column(type="integer")
     *
     * @var int
     */
    protected $status = self::STATUS_ENABLED;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OAuth
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OAuth
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return OAuth
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return OAuth
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     * @return OAuth
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    /**
     * @return string
     */
    public function getHostedDomain()
    {
        return $this->hostedDomain;
    }

    /**
     * @param string $hostedDomain
     * @return OAuth
     */
    public function setHostedDomain($hostedDomain)
    {
        $this->hostedDomain = $hostedDomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getGraphApiVersion()
    {
        return $this->graphApiVersion;
    }

    /**
     * @param string $graphApiVersion
     * @return OAuth
     */
    public function setGraphApiVersion($graphApiVersion)
    {
        $this->graphApiVersion = $graphApiVersion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     * @return OAuth
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return OAuth
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
