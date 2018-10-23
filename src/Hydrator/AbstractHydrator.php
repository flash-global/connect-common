<?php

namespace Fei\Service\Connect\Common\Hydrator;

use Fei\Entity\EntityInterface;

/**
 * Class AbstractHydrator
 * @package Fei\Service\Connect\Common\Hydrator
 */
class AbstractHydrator
{
    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return EntityInterface
     */
    public function hydrate(EntityInterface $entity, array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (!method_exists($entity, $setter)) {
                throw new \RuntimeException(sprintf('Unable to found setter for "%s" data key', $key));
            }

            $entity->$setter($value);
        }

        return $entity;
    }
}
