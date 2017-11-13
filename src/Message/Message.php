<?php

namespace Fei\Service\Connect\Common\Message;


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

    public function sign()
    {
        // TODO: Implement sign() method.
    }

    public function isSignatureValid()
    {
        return true;
        // TODO: Implement isSignatureValid() method.
    }

    public function hydrate($data)
    {
        $this->setData($data['data']);
        $this->setCertificat($data['certificat']);
        $this->setSignature($data['signature']);
    }

    public function jsonSerialize()
    {
        return [
            'data'      => $this->getData(),
            'signature' => $this->getSignature(),
            'certificat'=> $this->getCertificat()
        ];
    }


}