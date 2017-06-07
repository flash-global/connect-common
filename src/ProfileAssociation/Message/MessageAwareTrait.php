<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

/**
 * Trait MessageAwareTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
trait MessageAwareTrait
{
    /**
     * @var MessageInterface
     */
    protected $profileAssociationMessage;

    /**
     * Get Message
     *
     * @return MessageInterface
     */
    public function getProfileAssociationMessage() : MessageInterface
    {
        return $this->profileAssociationMessage;
    }

    /**
     * Set Message
     *
     * @param MessageInterface $profileAssociationMessage
     *
     * @return $this
     */
    public function setProfileAssociationMessage(MessageInterface $profileAssociationMessage)
    {
        $this->profileAssociationMessage = $profileAssociationMessage;

        return $this;
    }
}
