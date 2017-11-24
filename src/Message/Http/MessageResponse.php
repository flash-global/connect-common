<?php

namespace Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Message\MessageInterface;
use Zend\Diactoros\Response;

/**
 * Class ProfileAssociationResponse
 *
 * @package Fei\Service\Connect\Client\Message
 */
class MessageResponse extends Response
{
    use BodyBuilderTrait;

    /**
     * ProfileAssociationResponse constructor.
     *
     * @param MessageInterface $message
     * @param int              $status
     * @param array            $headers
     */
    public function __construct(MessageInterface $message, $status = 200, array $headers = [])
    {
        $this->setMessage($message);

        parent::__construct('php://memory', $status, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpMessage()
    {
        return $this;
    }
}
