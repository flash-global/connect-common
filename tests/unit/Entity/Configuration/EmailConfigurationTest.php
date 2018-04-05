<?php

namespace Test\Fei\Service\Connect\Common\Entity\Configuration;

use Fei\Service\Connect\Common\Entity\Configuration\EmailConfiguration;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailConfigurationTest
 *
 * @package Test\Fei\Service\Connect\Common\Entity\Configuration
 */
class EmailConfigurationTest extends TestCase
{
    public function testEmailSenderAccessors()
    {
        $configuration = new EmailConfiguration();

        $configuration->setEmailSender('myemail@test.fr');

        $this->assertEquals('myemail@test.fr', $configuration->getEmailSender());
        $this->assertAttributeEquals($configuration->getEmailSender(), 'emailSender', $configuration);
    }

    public function testEmailSubjectPrefixAccessors()
    {
        $configuration = new EmailConfiguration();

        $configuration->setEmailSubjectPrefix('My subject prefix');

        $this->assertEquals('My subject prefix', $configuration->getEmailSubjectPrefix());
        $this->assertAttributeEquals($configuration->getEmailSubjectPrefix(), 'emailSubjectPrefix', $configuration);
    }

    public function testEmailBodySignatureAccessors()
    {
        $configuration = new EmailConfiguration();

        $configuration->setEmailBodySignature('My body signature');

        $this->assertEquals('My body signature', $configuration->getEmailBodySignature());
        $this->assertAttributeEquals($configuration->getEmailBodySignature(), 'emailBodySignature', $configuration);
    }
}
