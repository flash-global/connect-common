<?php
/**
 * Created by PhpStorm.
 * User: alo
 * Date: 29/11/2016
 * Time: 10:49
 */

namespace Test\Fei\Service\Connect\Common\Entity;


use Fei\Service\Connect\Common\Entity\ForeignServiceId;
use PHPUnit\Framework\TestCase;

class ForeignServiceIdTest extends TestCase
{
    public function testNameAccessors()
    {
        $foreignServiceId = new ForeignServiceId();

        $foreignServiceId->setName('test');

        $this->assertEquals('test', $foreignServiceId->getName());
        $this->assertAttributeEquals($foreignServiceId->getName(), 'name', $foreignServiceId);
    }

    public function testIdAccesors()
    {
        $foreignServiceId = new ForeignServiceId();

        $foreignServiceId->setId('test');

        $this->assertEquals('test', $foreignServiceId->getId());
        $this->assertAttributeEquals($foreignServiceId->getId(), 'id', $foreignServiceId);
    }
}
