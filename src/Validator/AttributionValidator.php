<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\Exception;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\User;

/**
 * Class AttributionValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class AttributionValidator extends AbstractValidator
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
        if (!$entity instanceof Attribution) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', Attribution::class)
            );
        }

        $this->validateSource($entity->getSource());
        $this->validateTarget($entity->getTarget());
        $this->validateRole($entity->getRole());
        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate source
     *
     * @param $source
     *
     * @return bool
     * @throws \Fei\Entity\Validator\Exception
     */
    public function validateSource($source)
    {
        $validator = $source instanceof User ? new UserValidator() : new UserGroupValidator();
        $response = $validator->validate($source);

        if (!$response) {
            $this->addError(
                'user',
                'User must be a valid instance of User class - ' . $validator->getErrorsAsString()
            );
        }

        return $response;
    }

    /**
     * Validate target
     *
     * @param $target
     *
     * @return bool
     * @throws \Fei\Entity\Validator\Exception
     */
    public function validateTarget($target)
    {
        $validator = $target instanceof Application ? new ApplicationValidator() : new ApplicationGroupValidator();
        $response = $validator->validate($target);

        if (!$response) {
            $this->addError(
                'application',
                'Application must be a valid instance of Application class - ' .
                    $validator->getErrorsAsString()
            );
        }

        return $response;
    }

    /**
     * Validate role
     *
     * @param $role
     *
     * @return bool
     * @throws \Fei\Entity\Validator\Exception
     */
    public function validateRole($role)
    {
        $roleValidator = new RoleValidator();
        $response = $roleValidator->validate($role);

        if (!$response) {
            $this->addError(
                'role',
                'Role must be a valid instance of Role class - ' . $roleValidator->getErrorsAsString()
            );
        }

        return $response;
    }
}
