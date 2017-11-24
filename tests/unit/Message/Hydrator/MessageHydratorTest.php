<?php

namespace Test\Fei\Service\Connect\Common\Message\Hydrator;

use Fei\Service\Connect\Common\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageHydratorTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message\Hydrator
 */
class MessageHydratorTest extends TestCase
{
    public function testMessageIsHydrated()
    {
        $hydrator = new MessageHydrator();
        $message = new UsernamePasswordMessage();

        $data = [
            'username' => 'test',
            'password' => 'pass',
            'roles' => [
                'test1',
                'test2'
            ]
        ];

        $hydrator->hydrate($message, $data);

        $this->assertEquals('test', $message->getUsername());
        $this->assertEquals('pass', $message->getPassword());
        $this->assertEquals(['test1', 'test2'], $message->getRoles());
    }

    public function testHydrateFailWithWrongData()
    {
        $hydrator = new MessageHydrator();
        $message = new UsernamePasswordMessage();

        $data = [
            'error' => 'test'
        ];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unable to found setter for "error" data key');

        $hydrator->hydrate($message, $data);
    }
}
