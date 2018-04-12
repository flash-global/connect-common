<?php

namespace Fei\Service\Connect\Common\Exception;

/**
 * Class ValidatorException
 *
 * @package Fei\Service\Connect\Common\Exception
 */
class ValidatorException extends \LogicException
{
    protected $errors = [];

    /**
     * Get Errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Set Errors
     *
     * @param array $errors
     *
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;

        return $this;
    }
}
