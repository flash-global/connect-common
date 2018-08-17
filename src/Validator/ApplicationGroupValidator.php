<?php

namespace Fei\Service\Connect\Common\Validator;

use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Role;

/**
 * Class ApplicationGroupValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class ApplicationGroupValidator extends AbstractValidator
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
        if (!$entity instanceof ApplicationGroup) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', Role::class)
            );
        }

        $this->validateName($entity->getName());
        $errors = $this->getErrors();

        return empty($errors);
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
            $this->addError('name', 'Name cannot be empty');
            return false;
        }

        if (!is_string($label)) {
            $this->addError('name', 'Name must be a string');
            return false;
        }

        if (mb_strlen($label, 'UTF-8') > 255) {
            $this->addError('name', 'Name length has to be less or equal to 255');
            return false;
        }

        return true;
    }
}
