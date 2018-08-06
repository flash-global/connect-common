<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fei\Service\Connect\Common\Transformer\UserGroupMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\UserMinimalTransformer;

/**
 * Class Application
 *
 * @Entity
 * @Table(name="applications")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Application extends AbstractTarget
{
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 2;

    /**
     * @Column(type="string", unique=true)
     *
     * @var string Application name
     */
    protected $name;

    /**
     * @Column(type="string", unique=true)
     *
     * @var string
     */
    protected $url;

    /**
     * @Column(type="integer")
     *
     * @var int
     */
    protected $status = self::STATUS_ENABLED;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $logoUrl;

    /**
     * @Column(type="boolean")
     *
     * @var bool
     */
    protected $isSubscribed = false;

    /**
     * @Column(type="boolean")
     *
     * @var bool
     */
    protected $isManageable = false;

    /**
     * @Column(type="text")
     *
     * @var string
     */
    protected $config = '';

    /**
     * @Column(type="json_array")
     * @var array
     */
    protected $contexts = [];

    /**
     * Many Applications have Many Groups
     *
     * @ManyToMany(targetEntity="ApplicationGroup", inversedBy="applications")
     * @JoinTable(name="applications_has_groups")
     *
     * @var Collection|ApplicationGroup[]
     */
    protected $applicationGroups = [];

    /**
     * Application constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->setApplicationGroups(new ArrayCollection());

        parent::__construct($data);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set Url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * Fetch all possible statuses for an application
     *
     * @return array
     */
    public static function fetchStatuses()
    {
        $statuses = [
            self::STATUS_ENABLED  => 'Enabled',
            self::STATUS_DISABLED => 'Disabled'
        ];

        return $statuses;
    }

    /**
     * Get LogoUrl
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * Set LogoUrl
     *
     * @param string $logoUrl
     *
     * @return $this
     */
    public function setLogoUrl($logoUrl = null)
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Get isSubscribed
     *
     * @return bool
     */
    public function getIsSubscribed()
    {
        return $this->isSubscribed;
    }

    /**
     * Set isSubscribed
     *
     * @param  $isSubscribed
     * @return $this
     */
    public function setIsSubscribed($isSubscribed)
    {
        $this->isSubscribed = $isSubscribed;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsManageable()
    {
        return $this->isManageable;
    }

    /**
     * @param bool $isManageable
     * @return Application
     */
    public function setIsManageable($isManageable)
    {
        $this->isManageable = $isManageable;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param string $config
     * @return Application
     */
    public function setConfig($config)
    {
        $this->config = $config;
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
     * @return Application
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

    /**
     * Get ApplicationGroups
     *
     * @return Collection|ApplicationGroup[]
     */
    public function getApplicationGroups(): Collection
    {
        return $this->applicationGroups;
    }

    /**
     * Set ApplicationGroups
     *
     * @param Collection|ApplicationGroup[] $applicationGroups
     *
     * @return $this
     */
    public function setApplicationGroups(Collection $applicationGroups)
    {
        $this->applicationGroups = $applicationGroups;

        return $this;
    }

    /**
     * Add application groups
     *
     * @param ApplicationGroup ...$groups
     *
     * @return $this
     */
    public function addApplicationGroups(ApplicationGroup ...$groups)
    {
        foreach ($groups as $group) {
            $this->getApplicationGroups()->add($group);
        }

        return $this;
    }

    /**
     * Remove application groups
     *
     * @param ApplicationGroup ...$groups
     *
     * @return $this
     */
    public function removeApplicationGroups(ApplicationGroup ...$groups)
    {
        foreach ($groups as $group) {
            $this->getApplicationGroups()->removeElement($group);
        }

        return $this;
    }


    public function toArray($mapped = false)
    {
        $array = parent::toArray($mapped);

        return $array;
    }
}
