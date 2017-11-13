<?php

namespace Fei\Service\Connect\Common\Message;

class EncryptedMessage implements EncryptedMessageInterface
{
    /**
     * @var string $data
     */
    protected $data;

    /**
     * @var string $certificat
     */
    protected $certificat;

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return EncryptedMessage
     */
    public function setData($data)
    {
        $this->data = $data;
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
     * @return EncryptedMessage
     */
    public function setCertificat($certificat)
    {
        $this->certificat = $certificat;
        return $this;
    }

    public function encrypt(MessageInterface $message)
    {
        // TODO: Implement encrypt() method.
    }

    public function decrypt()
    {
        // TODO: Implement decrypt() method.
    }

    public function sign()
    {
        // TODO: Implement sign() method.
    }

    public function isSignatureValid()
    {
        // TODO: Implement isSignatureValid() method.
    }


    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }


}