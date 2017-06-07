<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message\Hydrator;

use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageInterface;

/**
 * Class MessageHydrator
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message\Hydrator
 */
class MessageHydrator
{
    public function hydrate(MessageInterface $message, array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (!method_exists($message, $setter)) {
                throw new \RuntimeException(sprintf('Unable to found setter for "%s" data key', $key));
            }

            $message->$setter($value);
        }
    }
}
