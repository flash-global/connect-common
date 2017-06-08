<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

/**
 * Class RequestMessage
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
interface RequestMessageInterface extends MessageInterface
{
    /**
     * Return roles to assign
     *
     * @return string[]
     */
    public function getRoles();
}
