<?php

namespace Fei\Service\Connect\Common\Transformer\Configuration;

use Fei\Service\Connect\Common\Entity\Configuration\Configuration;
use Fei\Service\Connect\Common\Entity\Configuration\ConfigurationInterface;

/**
 * Class ConfigurationTransformerInterface
 *
 * @package Fei\Service\Connect\Common\Transformer\Configuration
 */
interface ConfigurationTransformerInterface
{
    /**
     * Transform a ConfigurationInterface into an array
     *
     * @param ConfigurationInterface $config
     *
     * @return array
     */
    public function transform(ConfigurationInterface $config);

    /**
     * Transform a list of Configurations into a ConfigurationInterface
     *
     * @param Configuration[] ...$configs
     *
     * @return mixed
     */
    public function extract(Configuration ...$configs);
}
