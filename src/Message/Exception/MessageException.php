<?php

namespace Fei\Service\Connect\Common\Message\Exception;

use Fei\Service\Connect\Common\Exception\ResponseExceptionInterface;
use Fei\Service\Connect\Common\Message\ErrorMessage;
use Fei\Service\Connect\Common\Message\Http\MessageResponse;

/**
 * Class ProfileAssociationException
 *
 * @package Fei\Service\Connect\Client\Exception
 */
class MessageException extends \Exception implements ResponseExceptionInterface
{
    /**
     * @var string
     */
    protected $certificate;

    /**
     * Get Certificate
     *
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * Set Certificate
     *
     * @param string $certificate
     *
     * @return $this
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        $response = new MessageResponse((new ErrorMessage())->setError($this->getMessage()));

        $status = $code = ($this->getCode() < 100 || $this->getCode() > 599) ? 500 : $this->getCode();

        if ($this->getCertificate()) {
            $response = $response->buildEncrypted($this->getCertificate());
        } else {
            $response = $response->build();
        }

        $response = $response->withStatus($status);

        return $response;
    }
}
