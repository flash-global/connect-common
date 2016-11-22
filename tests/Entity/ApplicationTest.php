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
}
