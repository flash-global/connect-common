<?php

namespace Fei\Service\Connect\Common\Message;

interface EncryptedMessageInterface extends MessageInterface
{
    public function encrypt(MessageInterface $message);
    public function decrypt();
}