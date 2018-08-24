<?php

namespace Test\Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\UserGroup;
use Fei\Service\Connect\Common\Transformer\UserGroupMinimalTransformer;
use PHPUnit\Framework\TestCase;

/**
 * Class UserGroupMinimalTransformerTest
 *
 * @package Test\Fei\Service\Connect\Common\Transformer
 */
class UserGroupMinimalTransformerTest extends TestCase
{
    public function testTransform()
    {
        $userGroup = (new UserGroup())
            ->setId(1)
            ->setName('Group 1')
            ->setDefaultRole(
                (new Role())
                    ->setId(1)
                    ->setRole('USER')
                    ->setLabel('Test')
                    ->setUserCreated(true)
            );

        $transformer = new UserGroupMinimalTransformer();

        $this->assertEquals(
            [
                'id' => 1,
                'name' => 'Group 1',
                'default_role' => [
                    'id' => 1,
                    'role' => 'USER',
                    'label' => 'Test',
                    'user_created' => true
                ]
            ],
            $transformer->transform($userGroup)
        );
    }
}
