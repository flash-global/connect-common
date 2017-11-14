<?php

namespace Fei\Service\Connect\Common\Message;

interface MessageInterface extends \JsonSerializable
{
    public function sign($privateKey);
    public function isSignatureValid();
}