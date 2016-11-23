<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\Exception;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Service\Connect\Common\Entity\Attribution;

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

        $this->validateUser($entity->getUser());
        $this->validateApplication($entity->getApplication());
        $this->validateRole($entity->getRole());
        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate user
     *
     * @param $user
     *
     * @return bool
     * @throws \Fei\Entity\Validator\Exception
     */
    public function validateUser($user)
    {
        $userValidator = new UserValidator();
        $response = $userValidator->validate($user);

        if(!$response)
        {
            $this->addError('user', 'User must be a valid instance of User class - ' . $userValidator->getErrorsAsString());
        }

        return $response;
    }

    /**
     * Validate application
     *
     * @param $application
     *
     * @return bool
     * @throws \Fei\Entity\Validator\Exception
     */
    public function validateApplication($application)
    {
        $applicationValidator = new ApplicationValidator();
        $response = $applicationValidator->validate($application);

        if(!$response)
        {
            $this->addError('application', 'Application must be a valid instance of Application class - ' . $applicationValidator->getErrorsAsString());
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

        if(!$response)
        {
            $this->addError('role', 'Role must be a valid instance of Role class - ' . $roleValidator->getErrorsAsString());
        }

        return $response;
    }
}
