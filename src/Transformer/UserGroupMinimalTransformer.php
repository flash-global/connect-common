<?php

namespace Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\UserGroup;
use League\Fractal\TransformerAbstract;

/**
 * Class UserGroupMinimalTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class UserGroupMinimalTransformer extends TransformerAbstract
{
    /**
     * @param UserGroup $userGroup
     * @return array
     */
    public function transform(UserGroup $userGroup)
    {
        $defaultRole = $userGroup->getDefaultRole() ?? null;

        return [
            'id' => $userGroup->getId(),
            'name' => $userGroup->getName(),
            'default_role' => $defaultRole instanceof Role ? $defaultRole->toArray() : null
        ];
    }
}
