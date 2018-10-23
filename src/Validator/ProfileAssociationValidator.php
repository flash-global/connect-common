<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Service\Connect\Common\Entity\ProfileAssociation;

/**
 * Class ProfileAssociationValidator
 * @package Fei\Service\Connect\Common\Validator
 */
class ProfileAssociationValidator extends AbstractValidator
{
    /**
     * @param ProfileAssociation $entity
     * @return bool|void
     */
    public function validate(EntityInterface $entity)
    {
        if (!$entity instanceof ProfileAssociation) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', ProfileAssociation::class)
            );
        }

        $this->validateProfile($entity->getProfile());
        $this->validateRole($entity->getRole());

        return empty($this->errors) ?? $this->getErrorsAsString();
    }

    /**
     * @param $profile
     * @return bool
     */
    public function validateProfile($profile)
    {
        if (empty($profile)) {
            $this->addError('profile', 'ProfileAssociation profile cannot be empty');
            return false;
        }

        if (!is_string($profile)) {
            $this->addError('profile', 'ProfileAssociation profile must be a string');
            return false;
        }

        if (mb_strlen($profile, 'UTF-8') > 255) {
            $this->addError('profile', 'ProfileAssociation profile length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * @param $role
     * @return bool
     */
    public function validateRole($role)
    {
        if (empty($role)) {
            $this->addError('role', 'ProfileAssociation role cannot be empty');
            return false;
        }

        if (!is_string($role)) {
            $this->addError('role', 'ProfileAssociation role must be a string');
            return false;
        }

        if (mb_strlen($role, 'UTF-8') > 255) {
            $this->addError('role', 'ProfileAssociation role length has to be less or equal to 255');
            return false;
        }

        return true;
    }
}
