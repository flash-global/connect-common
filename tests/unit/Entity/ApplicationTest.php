<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Service\Connect\Common\Entity\Application;
use PHPUnit\Framework\TestCase;

/**
 * Class ApplicationTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class ApplicationTest extends TestCase
{
    public function testIdAccessors()
    {
        $application = new Application();

        $application->setId(1);

        $this->assertEquals(1, $application->getId());
        $this->assertAttributeEquals($application->getId(), 'id', $application);
    }

    public function testNameAccessors()
    {
        $application = new Application();

        $application->setName('test');

        $this->assertEquals('test', $application->getName());
        $this->assertAttributeEquals($application->getName(), 'name', $application);
    }

    public function testStatusAccessors()
    {
        $application = new Application();

        $application->setStatus(Application::STATUS_DISABLED);

        $this->assertEquals(Application::STATUS_DISABLED, $application->getStatus());
        $this->assertAttributeEquals($application->getStatus(), 'status', $application);
    }

    public function testFetchStatuses()
    {
        $expected = [
            Application::STATUS_ENABLED  => 'Enabled',
            Application::STATUS_DISABLED => 'Disabled'
        ];

        $result = Application::fetchStatuses();

        $this->assertEquals($expected, $result);
    }

    public function testLogoUrlAccessors()
    {
        $application = new Application();

        $application->setLogoUrl('test');

        $this->assertEquals('test', $application->getLogoUrl());
        $this->assertAttributeEquals($application->getLogoUrl(), 'logoUrl', $application);
    }

    public function testAllowProfileAssociation()
    {
        $application = new Application();

        $application->setAllowProfileAssociation(true);

        $this->assertEquals(true, $application->getAllowProfileAssociation());
        $this->assertAttributeEquals(
            $application->getAllowProfileAssociation(),
            'allowProfileAssociation',
            $application
        );
    }

    public function testIsSubscribed()
    {
        $application = new Application();

        $application->setIsSubscribed(true);

        $this->assertEquals(true, $application->getIsSubscribed());
        $this->assertAttributeEquals(
            $application->getIsSubscribed(),
            'isSubscribed',
            $application
        );
    }

    public function testIsManageable()
    {
        $application = new Application();
        $application->setIsManageable(true);

        $this->assertEquals(true, $application->getIsManageable());
        $this->assertAttributeEquals(
            $application->getIsManageable(),
            'isManageable',
            $application
        );
    }

    public function testContexts()
    {
        $contexts  = ['key' => 'value'];
        $contexts2 = ['key2' => 'value2'];
        $application = new Application();
        $application->setContexts($contexts);

        $this->assertEquals($contexts, $application->getContexts());
        $application->setContexts($contexts2, false);
        $this->assertEquals($contexts+$contexts2, $application->getContexts());


        $application = new Application();
        $application->addContext('key', 'value');

        $this->assertEquals('value', $application->retrieveContext('key'));
    }

    public function testConfig()
    {
        $config = '<EntityDescriptor entityID="http://127.0.0.1:8207" ID="_d75dfa42671b27489f6ac1ed2b1340cec8876deaf4" />';

        $application = new Application();
        $application->setConfig($config);

        $this->assertEquals($config, $application->getConfig());
    }
}
