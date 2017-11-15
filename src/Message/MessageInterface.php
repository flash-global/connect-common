<?php

namespace Fei\Service\Connect\Common\Message;

/**
 * Interface MessageInterface
 *
 * @package Fei\Service\Connect\Common\Message
 */
interface MessageInterface extends \JsonSerializable
{
    /**
     * Get the message data
     *
     * @return array
     */
    public function getData();

    /**
     * Get the message signature
     *
     * @return string
     */
    public function getSignature();

    /**
     * Get the X.509 certificate for signature validation purpose
     *
     * @return string
     */
    public function getCertificate();

    /**
     * Sign the message
     *
     * @param string $privateKey
     */
    public function sign($privateKey);

    /**
     * Test if signature is valid
     *
     * @return bool
     */
    public function isSignatureValid();
}
