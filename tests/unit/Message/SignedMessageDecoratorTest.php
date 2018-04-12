<?php

namespace Test\Fei\Service\Connect\Common\Message;

use Fei\Service\Connect\Common\Admin\Message\PingMessage;
use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Message\SignedMessageDecorator;
use PHPUnit\Framework\TestCase;

/**
 * Class SignedMessageDecoratorTest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message
 */
class SignedMessageDecoratorTest extends TestCase
{

    public function testConstructor()
    {
        $ping  = new PingMessage();
        $class = new SignedMessageDecorator($ping);

        $this->assertEquals($ping, $class->getMessage());
    }

    public function testAccessors()
    {
        $this->oneAccessors('signature', '0fzefzefezf');
        $this->oneAccessors('certificate', 'rgererger');
    }

    public function testJsonSerialize()
    {
        $ping = (new PingMessage())
            ->setAvailable(true);

        $message = (new SignedMessageDecorator())
            ->setMessage($ping)
            ->setCertificate('certif')
            ->setSignature('signature');

        $this->assertEquals([
            'class' => PingMessage::class,
            'data' => [
                'available' => true
            ],
            'signature' => 'signature',
            'certificate' => 'certif'
        ], $message->jsonSerialize());
    }

    public function testSign()
    {
        $private = (new RsaKeyGen())->createPrivateKey();

        $ping = (new PingMessage())
            ->setAvailable(true);

        $message = (new SignedMessageDecorator())
            ->setMessage($ping);

        $message->sign($private);

        $this->assertNotEmpty($message->getSignature());
        $this->assertNotEmpty($message->getCertificate());

        return $message;
    }

    public function testIsSignatureValid()
    {
        $message = $this->testSign();

        $valid = $message->isSignatureValid();

        $this->assertEquals($valid, true);
    }

    protected function oneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);
        $class = new SignedMessageDecorator();
        $class->$setter($expected);
        $this->assertEquals($class->$getter(), $expected);
        $this->assertAttributeEquals($class->$getter(), $name, $class);
    }
}
