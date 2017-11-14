<?php

namespace Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Cryptography\Signature;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;

/**
 * Class Message
 *
 * @package Fei\Service\Connect\Common\Message
 */
class Message implements MessageInterface
{
    /**
     * @var array $data
     */
    protected $data;

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
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the message data
     *
     * @param array $data
     *
     * @return Message
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

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
     * @return Message
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
        $signature  = base64_encode((new Signature())
            ->sign(json_encode($this->getData()), $privateKey));

        if (empty($this->getCertificate())) {
            $this->setCertificate((new X509CertificateGen())->createX509Certificate($privateKey));
        }

        $this->setSignature($signature);
    }

    /**
     * {@inheritdoc}
     */
    public function isSignatureValid()
    {
        return (new Signature())->verify(
            json_encode($this->getData()),
            base64_decode($this->getSignature()),
            $this->getCertificate()
        );
    }

    /**
     * Hydrate the message entity
     *
     * @param array $data
     */
    public function hydrate(array $data)
    {
        $this->setData($data['data']);
        $this->setSignature($data['signature']);
        $this->setCertificate($data['certificate']);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'        => $this->getData(),
            'signature'   => $this->getSignature(),
            'certificate' => $this->getCertificate()
        ];
    }
}
