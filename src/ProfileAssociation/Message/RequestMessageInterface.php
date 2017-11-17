<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message;

use Fei\Service\Connect\Common\Message\MessageInterface;

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
