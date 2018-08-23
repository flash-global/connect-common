<?php

namespace Test\Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\DefaultRole;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Transformer\DefaultRoleMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\UserMinimalTransformer;
use PHPUnit\Framework\TestCase;

/**
 * Class UserMinimalTransformerTest
 *
 * @package Test\Fei\Service\Connect\Common\Transformer
 */
class DefaultRoleMinimalTransformerTest extends TestCase
{
    public function testTransform()
    {
        $defaultRole = (new DefaultRole())
            ->setApplication((new Application())->setId(1))
            ->setUser((new User())->setId(1))
            ->setRole((new Role())->setId(1));

        $transformer = new DefaultRoleMinimalTransformer();


        $data = $transformer->transform($defaultRole);

        $this->assertEquals($data, [
            'application' => $defaultRole->getApplication()->getId(),
            'user' => $defaultRole->getUser()->getId(),
            'role' => $defaultRole->getRole()->getId()
        ]);
    }
}
