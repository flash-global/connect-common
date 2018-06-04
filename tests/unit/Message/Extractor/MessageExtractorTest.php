<?php

namespace Test\Fei\Service\Connect\Common\Message\Extractor;

use Fei\Service\Connect\Common\Message\ErrorMessage;
use Fei\Service\Connect\Common\Message\Extractor\MessageExtractor;
use Fei\Service\Connect\Common\Message\Hydrator\MessageHydrator;
use Fei\Service\Connect\Common\Message\MessageDecorator;
use Fei\Service\Connect\Common\Message\MessageInterface;
use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageExtractor
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation\Message\Extractor
 */
class MessageExtractorTest extends TestCase
{
    /**
     * @dataProvider dataForTestExtract
     *
     * @param array $data
     * @param MessageInterface $expected
     */
    public function testExtract(array $data, MessageInterface $expected)
    {
        $extractor = new MessageExtractor();
        $extractor->setHydrator(new MessageHydrator());

        $this->assertEquals($expected, $extractor->extract($data));
    }

    public function dataForTestExtract()
    {
        return [
            [
                [
                    'class' => 'Fei\Service\Connect\Common\Message\ErrorMessage',
                    'data' => [
                        'error' => 'error!'
                    ]
                ],
                (new ErrorMessage())->setError('error!')
            ],
            [
                [
                    'class' => 'Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage',
                    'data' => [
                        'username' => 'test',
                        'password' => 'pass',
                        'roles' => ['test1', 'test2']
                    ]
                ],
                (new UsernamePasswordMessage())
                    ->setUsername('test')
                    ->setPassword('pass')
                    ->setRoles(['test1', 'test2'])
            ],
            [
                [
                    'class' => 'Fei\Service\Connect\Common\Message\MessageDecorator',
                    'data' =>
                        [
                            'class' => 'Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage',
                            'data' => [
                                'username' => 'test',
                                'password' => 'pass',
                                'roles' => ['test1', 'test2']
                            ]
                        ]
                ],
                (new MessageDecorator())->setMessage(
                    (new UsernamePasswordMessage())
                        ->setUsername('test')
                        ->setPassword('pass')
                        ->setRoles(['test1', 'test2'])
                )
            ]
        ];
    }

    /**
     * @dataProvider dataForTestExtractWithInvalidData
     *
     * @param array      $data
     * @param \Exception $exception
     */
    public function testExtractWithInvalidData(array $data, \Exception $exception)
    {
        $extractor = new MessageExtractor();
        $extractor->setHydrator(new MessageHydrator());

        $this->expectException(get_class($exception), $exception->getMessage());

        $extractor->extract($data);
    }

    public function dataForTestExtractWithInvalidData()
    {
        return [
            [
                [],
                new \RuntimeException('Unable to extract class name from data')
            ],
            [
                ['class' => 'Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage'],
                new \RuntimeException('Unable to extract message body from data')
            ],
            [
                [
                    'class' => 'Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage',
                    'data' => null
                ],
                new \RuntimeException('Message body from data must be an array')
            ]
        ];
    }

    /**
     * @dataProvider dataForTestExtractWithInvalidClassName
     *
     * @param array      $data
     * @param \Exception $exception
     */
    public function testExtractWithInvalidClassName(array $data, \Exception $exception)
    {
        $extractor = new MessageExtractor();
        $extractor->setHydrator(new MessageHydrator());

        $this->expectException(get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());

        $extractor->extract($data);
    }

    public function dataForTestExtractWithInvalidClassName()
    {
        return [
            [
                [
                    'class' => 'Fei\Service\Connect\Common\ProfileAssociation\Message\ErroMessage',
                    'data' => []
                ],
                new \RuntimeException(
                    'Class Fei\Service\Connect\Common\ProfileAssociation\Message\ErroMessage does\'nt exist'
                )
            ],
            [
                [
                    'class' => 'Fei\Service\Connect\Common\Cryptography\Cryptography',
                    'data' => []
                ],
                new \RuntimeException(
                    'Class must implement Fei\Service\Connect\Common\Message\MessageInterface'
                )
            ]
        ];
    }
}
