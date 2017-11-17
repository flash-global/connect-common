<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Message\ErrorMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class ErrorMessageTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class ErrorMessageTest extends TestCase
{
    public function testErrorAccessors()
    {
        $error = new ErrorMessage();

        $error->setError('error');

        $this->assertEquals('error', $error->getError());
        $this->assertAttributeEquals($error->getError(), 'error', $error);
    }

    public function testJsonSerialize()
    {
        $error = new ErrorMessage();
        $error->setError('error');

        $this->assertEquals(['error' => 'error'], $error->jsonSerialize());
    }
}
