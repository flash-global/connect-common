<?php

namespace Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\OAuth;
use League\Fractal\TransformerAbstract;

/**
 * Class OAuthTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class OAuthTransformer extends TransformerAbstract
{
    /**
     * @param OAuth $oAuth
     * @return array
     */
    public function transform(OAuth $oAuth)
    {
        return [
            'id' => $oAuth->getId(),
            'provider' => $oAuth->getProvider(),
            'name' => $oAuth->getName(),
            'clientId' => $oAuth->getClientId(),
            'clientSecret' => $oAuth->getClientSecret(),
            'redirectUri' => $oAuth->getRedirectUri(),
            'hostedDomain' => $oAuth->getHostedDomain(),
            'graphApiVersion' => $oAuth->getGraphApiVersion(),
            'status' => $oAuth->getStatus()
        ];
    }
}