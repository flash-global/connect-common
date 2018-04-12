<?php

namespace Fei\Service\Connect\Common\Entity\Configuration;

use Fei\Entity\AbstractEntity;

/**
 * Class EmailConfiguration
 *
 * @package Fei\Service\Connect\Common\Entity\Configuration
 */
class EmailConfiguration extends AbstractEntity implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $emailSender;

    /**
     * @var string
     */
    protected $emailSubjectPrefix;

    /**
     * @var string
     */
    protected $emailBodySignature;

    /**
     * Get EmailSender
     *
     * @return string
     */
    public function getEmailSender()
    {
        return $this->emailSender;
    }

    /**
     * Set EmailSender
     *
     * @param string $emailSender
     *
     * @return $this
     */
    public function setEmailSender(string $emailSender)
    {
        $this->emailSender = $emailSender;
        return $this;
    }

    /**
     * Get EmailSubjectPrefix
     *
     * @return string
     */
    public function getEmailSubjectPrefix()
    {
        return $this->emailSubjectPrefix;
    }

    /**
     * Set EmailSubjectPrefix
     *
     * @param string $emailSubjectPrefix
     *
     * @return $this
     */
    public function setEmailSubjectPrefix(string $emailSubjectPrefix)
    {
        $this->emailSubjectPrefix = $emailSubjectPrefix;
        return $this;
    }

    /**
     * Get EmailBodySignature
     *
     * @return string
     */
    public function getEmailBodySignature()
    {
        return $this->emailBodySignature;
    }

    /**
     * Set EmailBodySignature
     *
     * @param string $emailBodySignature
     *
     * @return $this
     */
    public function setEmailBodySignature(string $emailBodySignature)
    {
        $this->emailBodySignature = $emailBodySignature;
        return $this;
    }
}
