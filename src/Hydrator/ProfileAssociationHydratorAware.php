<?php

namespace Fei\Service\Connect\Common\Hydrator;

trait ProfileAssociationHydratorAware
{
    /**
     * @var ProfileAssociationHydrator $profilAssociationHydrator
     */
    protected $profilAssociationHydrator;

    /**
     * GET ProfilAssociationHydrator
     *
     * @return ProfileAssociationHydrator
     */
    public function getProfilAssociationHydrator(): ProfileAssociationHydrator
    {
        return $this->profilAssociationHydrator;
    }

    /**
     * SET ProfilAssociationHydrator
     *
     * @param ProfileAssociationHydrator $profilAssociationHydrator
     * @return $this
     */
    public function setProfilAssociationHydrator(ProfileAssociationHydrator $profilAssociationHydrator): self
    {
        $this->profilAssociationHydrator = $profilAssociationHydrator;
        return $this;
    }
}
