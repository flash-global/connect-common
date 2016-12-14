<?php

namespace Fei\Service\Connect\Common\Validator;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\Exception;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Service\Connect\Common\Entity\User;

/**
 * Class UserValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class UserValidator extends AbstractValidator
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
        if (!$entity instanceof User) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', User::class)
            );
        }

        $this->validateUserName($entity->getUserName());
        $this->validateFirstName($entity->getFirstName());
        $this->validateLastName($entity->getLastName());
        $this->validateEmail($entity->getEmail());
        $this->validateCreatedAt($entity->getCreatedAt());
        $this->validatePassword($entity->getPassword());
        $this->validateStatus($entity->getStatus());
        $this->validateRegisterToken($entity->getStatus());
        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate password
     *
     *
     * @param mixed $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        // @TODO: Ask for password specifications

        if (mb_strlen($password, 'UTF-8') > 255) {
            $this->addError('password', 'Password length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate userName
     *
     * @param mixed $userName
     *
     * @return bool
     */
    public function validateUserName($userName)
    {
        if (empty($userName)) {
            $this->addError('userName', 'User name cannot be empty');
            return false;
        }

        if (!is_string($userName)) {
            $this->addError('userName', 'User name must be a string');
            return false;
        }

        if (mb_strlen($userName, 'UTF-8') > 255) {
            $this->addError('userName', 'User name length has to be less or equal to 255');
            return false;
        }


        return true;
    }

    /**
     * Validate firstName
     *
     * @param mixed $firstName
     *
     * @return bool
     */
    public function validateFirstName($firstName)
    {
        if (empty($firstName)) {
            $this->addError('firstName', 'First name cannot be empty');
            return false;
        }

        if (!is_string($firstName)) {
            $this->addError('firstName', 'First name must be a string');
            return false;
        }

        if (mb_strlen($firstName, 'UTF-8') > 255) {
            $this->addError('firstName', 'First name length has to be less or equal to 255');
            return false;
        }


        return true;
    }

    /**
     * Validate lastName
     *
     * @param mixed $lastName
     *
     * @return bool
     */
    public function validateLastName($lastName)
    {
        if (empty($lastName)) {
            $this->addError('lastName', 'Last name cannot be empty');
            return false;
        }

        if (!is_string($lastName)) {
            $this->addError('lastName', 'Last name must be a string');
            return false;
        }

        if (mb_strlen($lastName, 'UTF-8') > 255) {
            $this->addError('lastName', 'Last name length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate email
     *
     * @param mixed $email
     *
     * @return bool
     */
    public function validateEmail($email)
    {
        if (empty($email)) {
            $this->addError('email', 'Email cannot be empty');
            return false;
        }

        if (mb_strlen($email, 'UTF-8') > 255) {
            $this->addError('email', 'Email length has to be less or equal to 255');
            return false;
        }

        $emailValidator = new EmailValidator();
        if (!$emailValidator->isValid($email, new RFCValidation())) {
            $this->addError('email', 'Email must be an email address');
            return false;
        }

        return true;
    }

    /**
     * Validate createdAt
     *
     * @param mixed $createdAt
     *
     * @return bool
     */
    public function validateCreatedAt($createdAt)
    {
        if (empty($createdAt)) {
            $this->addError('createdAt', 'Creation date and time cannot be empty');
            return false;
        }

        if (!$createdAt instanceof \DateTime) {
            $this->addError('createdAt', 'The creation date has to be and instance of \DateTime');
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

        $valid = [User::STATUS_ACTIVE, User::STATUS_DELETED, User::STATUS_PENDING, User::STATUS_SUSPENDED];

        if (!in_array($status, $valid, true)) {
            $this->addError('status', 'Status must be equal to 0, 1, 2 or 3');
            return false;
        }

        return true;
    }

    /**
     * Validate registerToken
     *
     * @param mixed $registerToken
     *
     * @return bool
     */
    public function validateRegisterToken($registerToken)
    {
        if (mb_strlen($registerToken, 'UTF-8') > 36) {
            $this->addError('registerToken', 'Register token length has to be less or equal to 36');
            return false;
        }

        return true;
    }
}
