<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\UserGroup;

/**
 * Class UserGroupValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class UserGroupValidator extends AbstractValidator
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
        if (!$entity instanceof UserGroup) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', Role::class)
            );
        }

        $this->validateName($entity->getName());
        $this->validateDefaultRole($entity->getDefaultRole());
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
    public function validateDefaultRole($role)
    {
        if (empty($role)) {
            $this->addError('role', 'Role cannot be empty');
            return false;
        }

        if (!$role instanceof Role) {
            $this->addError('role', 'Role must be a Role entity');
            return false;
        }

        return true;
    }

    /**
     * Validate name
     *
     * @param mixed $label
     *
     * @return bool
     */
    public function validateName($label)
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
}
