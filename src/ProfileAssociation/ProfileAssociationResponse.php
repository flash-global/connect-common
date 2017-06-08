<?php

namespace Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Message\MessageInterface;
use Zend\Diactoros\Response;

/**
 * Class ProfileAssociationResponse
 *
 * @package Fei\Service\Connect\Client\Message
 */
class ProfileAssociationResponse extends Response
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
        $this->setProfileAssociationMessage($message);

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
