<?php

namespace Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Exception\ProfileAssociationException;
use Fei\Service\Connect\Common\ProfileAssociation\Message\RequestMessageInterface;
use Zend\Diactoros\ServerRequest;

/**
 * Class ProfileAssociationServerRequest
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationServerRequest extends ServerRequest
{
    /**
     * @var ProfileAssociationMessageExtractor
     */
    protected $profileAssociationMessageExtractor;

    /**
     * Get ProfileAssociationMessageExtractor
     *
     * @return ProfileAssociationMessageExtractor
     */
    public function getProfileAssociationMessageExtractor() : ProfileAssociationMessageExtractor
    {
        return $this->profileAssociationMessageExtractor;
    }

    /**
     * Set ProfileAssociationMessageExtractor
     *
     * @param ProfileAssociationMessageExtractor $profileAssociationMessageExtractor
     *
     * @return $this
     */
    public function setProfileAssociationMessageExtractor(
        ProfileAssociationMessageExtractor $profileAssociationMessageExtractor
    ) {
        $this->profileAssociationMessageExtractor = $profileAssociationMessageExtractor;

        return $this;
    }

    /**
     * Decrypt message from request contents body
     *
     * @param string $privateKey
     *
     * @return RequestMessageInterface
     *
     * @throws ProfileAssociationException
     */
    public function extract($privateKey) : RequestMessageInterface
    {
        /** @var RequestMessageInterface $message */
        $message = $this->getProfileAssociationMessageExtractor()->extract($this, $privateKey);

        return $message;
    }
}
