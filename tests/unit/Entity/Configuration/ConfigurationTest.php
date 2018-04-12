<?php

namespace Test\Fei\Service\Connect\Common\Entity\Configuration;

use Fei\Service\Connect\Common\Entity\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationTest
 *
 * @package Test\Fei\Service\Connect\Common\Entity\Configuration
 */
class ConfigurationTest extends TestCase
{
    public function testIdAccessors()
    {
        $configuration = new Configuration();

        $configuration->setId(1);

        $this->assertEquals(1, $configuration->getId());
        $this->assertAttributeEquals($configuration->getId(), 'id', $configuration);
    }

    public function testKeyAccessors()
    {
        $configuration = new Configuration();

        $configuration->setKey('my key');

        $this->assertEquals('my key', $configuration->getKey());
        $this->assertAttributeEquals($configuration->getKey(), 'key', $configuration);
    }

    public function testValueAccessors()
    {
        $configuration = new Configuration();

        $configuration->setValue('my value');

        $this->assertEquals('my value', $configuration->getValue());
        $this->assertAttributeEquals($configuration->getValue(), 'value', $configuration);
    }
}
