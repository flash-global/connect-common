<?php

namespace Fei\Service\Connect\Transformer;

use Fei\Service\Connect\Common\Entity\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserMinimalTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class UserMinimalTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->getId(),
            'userName' => $user->getUserName(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'status' => $user->getStatus(),
            'language' => $user->getLanguage()
        ];
    }
}