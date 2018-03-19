<?php

namespace Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Cryptography\Signature;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;

/**
 * Class Message
 *
 * @package Fei\Service\Connect\Common\Message
 */
class SignedMessageDecorator implements SignedMessageInterface, MessageDecoratorInterface
{
    use MessageAwareTrait;

    /**
     * MessageDecorator constructor.
     *
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message = null)
    {
        if (!is_null($message)) {
            $this->setMessage($message);
        }
    }

    /**
     * @var string $signature
     */
    protected $signature;

    /**
     * @var string $certificate
     */
    protected $certificate;

    /**
     * {@inheritdoc}
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set the message signature
     *
     * @param string $signature
     *
     * @return SignedMessageDecorator
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

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
    public function sign($privateKey)
    {
        $signature = base64_encode(
            (new Signature())->sign(json_encode($this->jsonSerialize()['data']), $privateKey)
        );

        if (empty($this->getCertificate())) {
            $this->setCertificate((new X509CertificateGen())->createX509Certificate($privateKey));
        }

        $this->setSignature($signature);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSignatureValid()
    {
        return (new Signature())->verify(
            json_encode($this->jsonSerialize()['data']),
            base64_decode($this->getSignature()),
            $this->getCertificate()
        );
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since  5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'class' => get_class($this->getMessage()),
            'data' => $this->getMessage()->jsonSerialize(),
            'signature' => $this->getSignature(),
            'certificate' => $this->getCertificate()
        ];
    }
}
