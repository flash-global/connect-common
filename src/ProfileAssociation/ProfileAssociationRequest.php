<?php

namespace Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Message\RequestMessageInterface;
use Psr\Http\Message\MessageInterface as HttpMessageInterface;
use Zend\Diactoros\Request;

/**
 * Class ProfileAssociationRequest
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationRequest extends Request
{
    use BodyBuilderTrait;

    /**
     * ProfileAssociationRequest constructor.
     *
     * @param RequestMessageInterface $message
     * @param null                    $uri
     * @param string                  $body
     * @param array                   $headers
     */
    public function __construct(
        RequestMessageInterface $message,
        $uri = null,
        $body = 'php://temp',
        array $headers = []
    ) {
        $this->setProfileAssociationMessage($message);

        parent::__construct($uri, 'POST', $body, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpMessage() : HttpMessageInterface
    {
        return $this;
    }
}
