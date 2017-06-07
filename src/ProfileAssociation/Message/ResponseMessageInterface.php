<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

/**
 * Interface ResponseMessageInterface
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
interface ResponseMessageInterface extends MessageInterface
{
    /**
     * Return the roles to assign
     *
     * @return string
     */
    public function getRole() : string;
}
