<?php

namespace Fei\Service\Connect\Common\Message;

interface MessageInterface extends \JsonSerializable
{
    public function sign();
    public function isSignatureValid();
}