<?php

namespace Fei\Service\Connect\Common\Validator;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Fei\Entity\EntityInterface;
use Fei\Entity\Validator\Exception;
use Fei\Entity\Validator\AbstractValidator;
use Fei\Service\Connect\Common\Entity\Configuration\EmailConfiguration;
use Fei\Service\Connect\Common\Transformer\Configuration\EmailConfigurationTransformer;

/**
 * Class EmailConfigurationValidator
 *
 * @package Fei\Service\Connect\Common\Validator
 */
class EmailConfigurationValidator extends AbstractValidator
{
    /**
     * Validate an EmailConfiguration instance
     *
     * @param EntityInterface $entity
     *
     * @return bool
     *
     * @throws Exception
     */
    public function validate(EntityInterface $entity)
    {
        if (!$entity instanceof EmailConfiguration) {
            throw new Exception(
                sprintf('The Entity to validate must be an instance of %s', EmailConfiguration::class)
            );
        }

        $this->validateEmailSender($entity->getEmailSender());
        $this->validateEmailSenderName($entity->getEmailSenderName());
        $this->validateEmailSubjectPrefix($entity->getEmailSubjectPrefix());
        $this->validateEmailBodySignature($entity->getEmailBodySignature());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate sender email address
     *
     * @param mixed $email
     *
     * @return bool
     */
    public function validateEmailSender($email)
    {
        if (mb_strlen($email, 'UTF-8') > 255) {
            $this->addError(EmailConfigurationTransformer::EMAIL_SENDER, 'Sender email length has to be less or equal to 255');
            return false;
        }

        if (!empty($email)) {
            $emailValidator = new EmailValidator();
            if (!$emailValidator->isValid($email, new RFCValidation())) {
                $this->addError(EmailConfigurationTransformer::EMAIL_SENDER, 'Sender email must be an email address');
                return false;
            }
        }

        return true;
    }

    /**
     * Validate sender name
     *
     * @param string $name
     *
     * @return bool
     */
    public function validateEmailSenderName($name)
    {
        if (mb_strlen($name, 'UTF-8') > 255) {
            $this->addError(EmailConfigurationTransformer::EMAIL_SENDER_NAME, 'Sender name length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate subject prefix
     *
     * @param mixed $subjectPrefix
     *
     * @return bool
     */
    public function validateEmailSubjectPrefix($subjectPrefix)
    {
        if (mb_strlen($subjectPrefix, 'UTF-8') > 255) {
            $this->addError(EmailConfigurationTransformer::EMAIL_SUBJECT_PREFIX, 'Subject prefix length has to be less or equal to 255');
            return false;
        }

        return true;
    }

    /**
     * Validate body signature
     *
     * @param mixed $bodySignature
     *
     * @return bool
     */
    public function validateEmailBodySignature($bodySignature)
    {
        return true;
    }
}
