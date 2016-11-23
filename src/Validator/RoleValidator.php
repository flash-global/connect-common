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
}
