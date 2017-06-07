<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor;

use Fei\Service\Connect\Common\ProfileAssociation\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageInterface;

/**
 * Class MessageExtractor
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class MessageExtractor
{
    /**
     * @var MessageHydrator
     */
    protected $hydrator;

    /**
     * Get Hydrator
     *
     * @return MessageHydrator
     */
    public function getHydrator() : MessageHydrator
    {
        return $this->hydrator;
    }

    /**
     * Set Hydrator
     *
     * @param MessageHydrator $hydrator
     *
     * @return $this
     */
    public function setHydrator(MessageHydrator $hydrator)
    {
        $this->hydrator = $hydrator;

        return $this;
    }

    /**
     * Extract a MessageInterface instance from data
     *
     * @param array $data
     *
     * @return MessageInterface
     */
    public function extract(array $data) : MessageInterface
    {
        if (!array_key_exists('class', $data)) {
            throw new \RuntimeException('Unable to extract class name from data');
        }

        if (!array_key_exists('body', $data)) {
            throw new \RuntimeException('Unable to extract message body from data');
        }

        if (!is_array($data['body'])) {
            throw new \RuntimeException('Message body from data must be an array');
        }

        if (!class_exists($data['class'])) {
            throw new \RuntimeException(sprintf('Class %s does\'nt exist', $data['class']));
        }

        if (!in_array(MessageInterface::class, class_implements($data['class']))) {
            throw new \RuntimeException(sprintf('Class must implement %s', MessageInterface::class));
        }

        $message = new $data['class'];

        $this->getHydrator()->hydrate($message, $data['body']);

        return $message;
    }
}
