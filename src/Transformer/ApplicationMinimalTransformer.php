<?php

namespace Fei\Service\Connect\Common\Transformer;

use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\User;
use League\Fractal\TransformerAbstract;

/**
 * Class ApplicationMinimalTransformer
 *
 * @package Fei\Service\Connect\Transformer
 */
class ApplicationMinimalTransformer extends TransformerAbstract
{
    /**
     * @param Application $application
     * @return array
     */
    public function transform(Application $application)
    {
        return [
            'id' => $application->getId(),
            'url' => $application->getUrl(),
            'name' => $application->getName(),
            'status' => $application->getStatus(),
            'logo_url' => $application->getLogoUrl(),
            'allow_profile_association' => $application->getAllowProfileAssociation(),
            'is_subscribed' => $application->getIsSubscribed(),
            'is_manageable' => $application->getIsManageable(),
            'config' => $application->getConfig(),
            'contexts' => $application->getContexts()
        ];
    }
}
