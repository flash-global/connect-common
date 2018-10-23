<?php

namespace Fei\Service\Connect\Common\Hydrator;

use Fei\Entity\EntityInterface;
use Fei\Service\Connect\Lib\Manager\ApplicationManagerAware;
use Fei\Service\Connect\Lib\Manager\UserManagerAware;

/*
 *
 */
class ProfileAssociationHydrator extends AbstractHydrator
{
    use UserManagerAware;
    use ApplicationManagerAware;

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return EntityInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function hydrate(EntityInterface $entity, array $data)
    {
        $data['user'] = $this->userManager->fetchOneById($data['user']);

        $data['application'] = $this->applicationManager->fetchOneById($data['application']);

        return parent::hydrate($entity, $data);
    }
}
