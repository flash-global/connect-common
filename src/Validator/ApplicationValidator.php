<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Application;

class ApplicationValidator extends AbstractValidator
{
    /**
     * Validate a Message instance
     *
     * @param EntityInterface $entity
     *
     * @return bool
     *
     * @throws Exception
     */
    public function validate(EntityInterface $entity)
    {
        if (!$entity instanceof Application) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', Application::class)
            );
        }

        $this->validateName($entity->getName());
        $this->validateUrl($entity->getUrl());
        $this->validateStatus($entity->getStatus());
        $this->validateLogoUrl($entity->getLogoUrl());
        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate name
     *
     * @param mixed $name
     *
     * @return bool
     */
    public function validateName($name)
    {
        if (empty($name)) {
            $this->addError('name', 'Name cannot be empty');
            return false;
        }

        if (!is_string($name)) {
            $this->addError('name', 'Name must be a string');
            return false;
        }

        if (mb_strlen($name, 'UTF-8') > 255) {
            $this->addError('name', 'Name length has to be less or equal to 255');
            return false;
        }


        return true;
    }

    /**
     * Validate url
     *
     * @param mixed $url
     *
     * @return bool
     */
    public function validateUrl($url)
    {
        if (empty($url)) {
            $this->addError('url', 'Url cannot be empty');
            return false;
        }

        if (!is_string($url)) {
            $this->addError('url', 'Url must be a string');
            return false;
        }

        if (mb_strlen($url, 'UTF-8') > 255) {
            $this->addError('url', 'Url length has to be less or equal to 255');
            return false;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $this->addError('url', 'Url must contain protocol and domain name');
            return false;
        }


        return true;
    }

    /**
     * Validate status
     *
     * @param mixed $status
     *
     * @return bool
     */
    public function validateStatus($status)
    {
        if ($status === null) {
            $this->addError('status', 'Status cannot be null');
            return false;
        }

        $valid = [Application::STATUS_ENABLED, Application::STATUS_DISABLED];

        if (!in_array($status, $valid, true)) {
            $this->addError('status', 'Status must be equal to 1 or 2');
            return false;
        }

        return true;
    }

    /**
     * Validate logo url
     *
     * @param mixed $url
     *
     * @return bool
     */
    public function validateLogoUrl($url)
    {
        if (empty($url)) {
            return true;
        }

        if (!is_string($url)) {
            $this->addError('url', 'Url must be a string');
            return false;
        }

        if (mb_strlen($url, 'UTF-8') > 255) {
            $this->addError('url', 'Url length has to be less or equal to 255');
            return false;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $this->addError('url', 'Url must contain protocol and domain name');
            return false;
        }

        return true;
    }
}
