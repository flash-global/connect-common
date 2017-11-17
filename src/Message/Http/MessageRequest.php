<?php

namespace Fei\Service\Connect\Common\Message\Http;

use Fei\Service\Connect\Common\Message\MessageInterface;
use Zend\Diactoros\Request;

/**
 * Class ProfileAssociationRequest
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
class MessageRequest extends Request
{
    use BodyBuilderTrait;

    /**
     * ProfileAssociationRequest constructor.
     *
     * @param MessageInterface $message
     * @param null             $uri
     * @param string           $body
     * @param array            $headers
     */
    public function __construct(
        MessageInterface $message,
        $uri = null,
        $body = 'php://temp',
        array $headers = []
    ) {
        $this->setMessage($message);

        parent::__construct($uri, 'POST', $body, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpMessage()
    {
        return $this;
    }
}
