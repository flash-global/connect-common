<?php

namespace Fei\Service\Connect\Common\ProfileAssociation\Cryptography;

/**
 * Class MessageCryptography
 *
 * @package Fei\Service\Connect\Common\Message
 */
class Cryptography
{
    /**
     * Encrypt message
     *
     * @param string $message
     * @param string $certificate
     *
     * @return string
     */
    public function encryptMessage(string $message, string $certificate) : string
    {
        $key = openssl_pkey_get_public($certificate);

        if ($key === false) {
            throw new \LogicException('Certificate isn\'t valid');
        }

        $length = 117;
        $output = '';
        while ($message) {
            $input = substr($message, 0, $length);
            $message = substr($message, $length);

            if (openssl_public_encrypt($input, $encrypted, $key) === false) {
                throw new \RuntimeException(openssl_error_string());
            }

            $output .= $encrypted;
        }

        return $output;
    }

    /**
     * Decrypt message
     *
     * @param string $message
     * @param mixed  $key
     *
     * @return string
     */
    public function decryptMessage(string $message, $key) : string
    {
        $key = openssl_pkey_get_private($key);

        if ($key === false) {
            throw new \LogicException('Private key isn\'t valid');
        }

        $length = 128;
        $output = '';
        while ($message) {
            $input = substr($message, 0, $length);
            $message = substr($message, $length);

            if (openssl_private_decrypt($input, $decrypted, $key) === false) {
                throw new \RuntimeException(openssl_error_string());
            }

            $output .= $decrypted;
        }

        return $output;
    }
}
