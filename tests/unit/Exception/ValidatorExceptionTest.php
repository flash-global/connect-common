<?php

namespace Test\Fei\Service\Connect\Common\Exception;

use Fei\Service\Connect\Common\Exception\ValidatorException;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidatorExceptionTest
 *
 * @package Test\Fei\Service\Connect\Common\Exception
 */
class ValidatorExceptionTest extends TestCase
{
    public function testErrorsAccessors()
    {
        $errors = [
            'error 1',
            'error 2'
        ];

        $exception = new ValidatorException();

        $exception->setErrors($errors);

        $this->assertEquals($errors, $exception->getErrors());
        $this->assertAttributeEquals($exception->getErrors(), 'errors', $exception);
    }
}