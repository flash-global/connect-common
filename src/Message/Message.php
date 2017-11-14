<?php

namespace Fei\Service\Connect\Common\Message;


use Fei\Service\Connect\Common\Cryptography\Signature;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;

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
     * @var string $certificat
     */
    protected $certificat;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Message
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return Message
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * @return string
     */
    public function getCertificat()
    {
        return $this->certificat;
    }

    /**
     * @param string $certificat
     * @return Message
     */
    public function setCertificat($certificat)
    {
        $this->certificat = $certificat;
        return $this;
    }

    /**
     * @param $privateKey
     */
    public function sign($privateKey)
    {
        $signature  = base64_encode((new Signature())
            ->sign(json_encode($this->getData()), $privateKey));

        $certificat = (new X509CertificateGen())
            ->createX509Certificate($privateKey);

        $this->setCertificat($certificat);
        $this->setSignature($signature);

    }

    /**
     * @return mixed
     */
    public function isSignatureValid()
    {
        return (new Signature())
            ->verify(json_encode($this->getData()), base64_decode($this->getSignature()), $this->getCertificat());
    }

    /**
     * @param $data
     */
    public function hydrate($data)
    {
        $this->setData($data['data']);
        $this->setCertificat($data['certificat']);
        $this->setSignature($data['signature']);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'      => $this->getData(),
            'signature' => $this->getSignature(),
            'certificat'=> $this->getCertificat()
        ];
    }


}