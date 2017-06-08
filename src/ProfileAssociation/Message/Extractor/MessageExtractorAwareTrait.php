<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor;

/**
 * Class MessageExtractorAwareTrait
 *
 * @package Fei\Service\Connect\Common\ProfileAssociation\Message
 */
trait MessageExtractorAwareTrait
{
    /**
     * @var MessageExtractor
     */
    protected $messageExtractor;

    /**
     * Get MessageExtractor
     *
     * @return MessageExtractor
     */
    public function getMessageExtractor()
    {
        return $this->messageExtractor;
    }

    /**
     * Set MessageExtractor
     *
     * @param MessageExtractor $messageExtractor
     *
     * @return $this
     */
    public function setMessageExtractor(MessageExtractor $messageExtractor)
    {
        $this->messageExtractor = $messageExtractor;

        return $this;
    }
}
