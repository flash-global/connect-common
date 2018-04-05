<?php

namespace Test\Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Transformer\UserMinimalTransformer;
use PHPUnit\Framework\TestCase;

/**
 * Class UserMinimalTransformerTest
 *
 * @package Test\Fei\Service\Connect\Common\Transformer
 */
class UserMinimalTransformerTest extends TestCase
{
    /**
     * @dataProvider dataTransform
     */
    public function testTransform($id, $userName, $firstName, $lastName, $email, $status, $language)
    {
        $transformer = new UserMinimalTransformer();

        $user = (new User())
            ->setId($id)
            ->setUserName($userName)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email)
            ->setStatus($status)
            ->setLanguage($language);

        $this->assertEquals(
            [
                'id'        => $id,
                'userName'  => $userName,
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'email'     => $email,
                'status'    => $status,
                'language'  => $language
            ],
            $transformer->transform($user)
        );
    }

    public function dataTransform()
    {
        return [
            [
                1,
                'Username',
                'First name',
                'Last name',
                'email@email.fr',
                User::STATUS_ACTIVE,
                'en'
            ],
            [
                100,
                'Username 2',
                'First name 2',
                'Last name 2',
                'email2@email.fr',
                User::STATUS_DELETED,
                'fr'
            ]
        ];
    }
}
