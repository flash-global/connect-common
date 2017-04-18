<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Role;

/**
 * Class RoleValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class RoleValidator extends AbstractValidator
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
        if (!$entity instanceof Role) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', Role::class)
            );
        }

        $this->validateRole($entity->getRole());
        $this->validateLabel($entity->getLabel());
        $this->validateUserCreated($entity->getUserCreated());
        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate role
     *
     * @param mixed $role
     *
     * @return bool
     */
    public function validateRole($role)
    {
        if (empty($role)) {
            $this->addError('role', 'Role cannot be empty');
            return false;
        }

        if (!is_string($role)) {
            $this->addError('role', 'Role must be a string');
            return false;
        }

        if (mb_strlen($role, 'UTF-8') > 255) {
            $this->addError('role', 'Role length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate label
     *
     * @param mixed $label
     *
     * @return bool
     */
    public function validateLabel($label)
    {
        if (empty($label)) {
            $this->addError('label', 'Label cannot be empty');
            return false;
        }

        if (!is_string($label)) {
            $this->addError('label', 'Label must be a string');
            return false;
        }

        if (mb_strlen($label, 'UTF-8') > 255) {
            $this->addError('label', 'Label length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate user created
     *
     * @param mixed $bool
     *
     * @return bool
     */
    public function validateUserCreated($bool)
    {
        if (!is_bool($bool) && !is_numeric($bool)) {
            $this->addError('user_created', 'User created must be a boolean or 0 or 1');
            return false;
        }

        if (0 != (integer) $bool && 1 != (integer) $bool) {
            $this->addError('user_created', 'User created must be a boolean or 0 or 1');
            return false;
        }

        return true;
    }
}
