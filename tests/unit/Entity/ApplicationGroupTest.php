<?php

namespace Test\Fei\Service\Connect\Common\Entity;

use Fei\Entity\EntitySet;
use Fei\Service\Connect\Common\Entity\Application;
use Fei\Service\Connect\Common\Entity\ApplicationGroup;
use Fei\Service\Connect\Common\Entity\Attribution;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Entity\User;
use Fei\Service\Connect\Common\Entity\UserGroup;
use PHPUnit\Framework\TestCase;

/**
 * Class ApplicationGroupTest
 *
 * @package Test\Fei\Service\Connect\Entity
 */
class ApplicationGroupTest extends TestCase
{
    public function testNameAccessors()
    {
        $application = new ApplicationGroup();

        $application->setName('test');

        $this->assertEquals('test', $application->getName());
        $this->assertAttributeEquals($application->getName(), 'name', $application);
    }

    public function testApplicationGroups()
    {
        $applicationGroup = (new ApplicationGroup());
        $application      = (new Application())->setId(23);

        $applicationGroup->addApplications($application);

        $this->assertEquals(23, $applicationGroup->getApplications()->toArray()[0]->getId());

        $applicationGroup->removeApplications($application);

        $this->assertEmpty($applicationGroup->getApplications()->toArray());
    }


    public function testToArray()
    {
        $applicationGroup = (new ApplicationGroup());
        $attribution = (new Attribution())
            ->setSource(new User())
            ->setRole((new Role())->setId(23))
            ->setTarget($applicationGroup);

        $attribution2 = (new Attribution())
            ->setSource(new UserGroup())
            ->setRole((new Role())->setId(23))
            ->setTarget($applicationGroup);


        $entitySet = new EntitySet();
        $entitySet->append($attribution);
        $entitySet->append($attribution2);

        $applicationGroup->setAttributions($entitySet);

        $array = $applicationGroup->toArray();

        $this->assertNotEmpty($array['users']);
        $this->assertNotEmpty($array['userGroups']);
    }
}
