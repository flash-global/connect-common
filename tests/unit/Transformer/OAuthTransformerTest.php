<?php

namespace Test\Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\OAuth;
use Fei\Service\Connect\Common\Transformer\OAuthTransformer;
use PHPUnit\Framework\TestCase;

/**
 * Class OAuthTransformerTest
 *
 * @package Test\Fei\Service\Connect\Common\Transformer
 */
class OAuthTransformerTest extends TestCase
{
    public function testTransform()
    {
        $transformer = new OAuthTransformer();

        $oAuth = (new OAuth())
            ->setId(2)
            ->setProvider('google')
            ->setName('default')
            ->setClientId('clientId')
            ->setClientSecret('clientSecret')
            ->setRedirectUri('redirectUri')
            ->setHostedDomain('hostedDomain')
            ->setGraphApiVersion('V2.8')
            ->setStatus(OAuth::STATUS_DISABLED);

        $this->assertEquals(
            [
                'id'        => 2,
                'provider'  => 'google',
                'name'      => 'default',
                'clientId'  => 'clientId',
                'clientSecret' => 'clientSecret',
                'redirectUri' => 'redirectUri',
                'hostedDomain' => 'hostedDomain',
                'graphApiVersion' => 'V2.8',
                'status' => OAuth::STATUS_DISABLED
            ],
            $transformer->transform($oAuth)
        );
    }

}
