<?php

namespace Fei\Service\Connect\Common\Message\Extractor;

use Fei\Service\Connect\Common\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\Message\MessageAwareInterface;
use Fei\Service\Connect\Common\Message\MessageInterface;

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
    public function getHydrator()
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
    public function extract(array $data)
    {
        if (!array_key_exists('class', $data)) {
            throw new \RuntimeException('Unable to extract class name from data');
        }

        if (!array_key_exists('data', $data)) {
            throw new \RuntimeException('Unable to extract message body from data');
        }

        if (!is_array($data['data'])) {
            throw new \RuntimeException('Message body from data must be an array');
        }

        if (!class_exists($data['class'])) {
            throw new \RuntimeException(sprintf('Class %s does\'nt exist', $data['class']));
        }

        if (!in_array(MessageInterface::class, class_implements($data['class']))) {
            throw new \RuntimeException(sprintf('Class must implement %s', MessageInterface::class));
        }

        $message = new $data['class'];

        if (is_subclass_of($data['class'], MessageAwareInterface::class)) {
            $message->setMessage($this->extract($data['data']));

            unset($data['data']['class']);
            unset($data['data']['data']);
        }

        return $this->getHydrator()->hydrate($message, $data['data']);
    }
}
