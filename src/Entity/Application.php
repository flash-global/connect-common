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
     * @Column(type="string")
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
}
