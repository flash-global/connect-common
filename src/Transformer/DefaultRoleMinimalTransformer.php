<?php

namespace Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\DefaultRole;
use League\Fractal\TransformerAbstract;

/**
 * Class ApplicationMinimalTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class DefaultRoleMinimalTransformer extends TransformerAbstract
{
    /**
     * @param DefaultRole $role
     * @return array
     */
    public function transform(DefaultRole $role)
    {
        return [
            'application' => $role->getApplication()->getId(),
            'user' => $role->getUser()->getId(),
            'role' => $role->getRole()->getId(),
        ];
    }
}
