<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Application
 *
 * @Entity
 * @Table(name="applications")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class Application extends AbstractEntity
{
    const ALLOW_PROFILE_ASSOCIATIONS = 'allow_profile_association';

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
     * @Column(type="string")
     *
     * @var string
     */
    protected $logoUrl;

    /**
     * @Column(type="boolean")
     *
     * @var bool
     */
    protected $allowProfileAssociation = false;

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
     * @Column(type="json_array")
     * @var array
     */
    protected $contexts = [];


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
     * Get AllowProfileAssociation
     *
     * @return bool
     */
    public function getAllowProfileAssociation()
    {
        return $this->allowProfileAssociation;
    }

    /**
     * Set AllowProfileAssociation
     *
     * @param bool $allowProfileAssociation
     *
     * @return $this
     */
    public function setAllowProfileAssociation($allowProfileAssociation)
    {
        $this->allowProfileAssociation = $allowProfileAssociation;

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
     * @param $isSubscribed
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

}
