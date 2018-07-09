<?php

namespace Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use League\Fractal\TransformerAbstract;

/**
 * Class ApplicationMinimalTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class ApplicationGroupMinimalTransformer extends TransformerAbstract
{
    /**
     * @param ApplicationGroup $applicationGroup
     * @return array
     */
    public function transform(ApplicationGroup $applicationGroup)
    {
        return [
            'id' => $applicationGroup->getId(),
            'name' => $applicationGroup->getName(),
        ];
    }
}
