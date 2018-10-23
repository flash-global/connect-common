<?php

namespace Fei\Service\Connect\Common\Validator;

/**
 * Trait ProfileAssociationValidatorAware
 * @package Fei\Service\Connect\Common\Validator
 */
trait ProfileAssociationValidatorAware
{
    /**
     * @var ProfileAssociationValidator $profilAssociationValidator
     */
    protected $profilAssociationValidator;

    /**
     * GET ProfilAssociationValidator
     *
     * @return ProfileAssociationValidator
     */
    public function getProfilAssociationValidator(): ProfileAssociationValidator
    {
        return $this->profilAssociationValidator;
    }

    /**
     * SET ProfilAssociationValidator
     *
     * @param ProfileAssociationValidator $profilAssociationValidator
     * @return $this
     */
    public function setProfilAssociationValidator(ProfileAssociationValidator $profilAssociationValidator): self
    {
        $this->profilAssociationValidator = $profilAssociationValidator;
        return $this;
    }
}
