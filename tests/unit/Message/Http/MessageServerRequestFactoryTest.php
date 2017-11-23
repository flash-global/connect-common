<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Message\Extractor\EncryptedMessageExtractor;
use Fei\Service\Connect\Common\Message\Http\MessageServerRequest;
use Fei\Service\Connect\Common\Message\Http\MessageServerRequestFactory;
use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageServerRequestFactoryTest
 *
 * @package Test\Fei\Service\Connect\Common\Message
 */
class MessageServerRequestFactoryTest extends TestCase
{
    public function testFromGlobals()
    {
        $class = new MessageServerRequestFactory();
        $return = $class->fromGlobals();

        $this->assertInstanceOf(MessageServerRequest::class, $return);
    }
}
