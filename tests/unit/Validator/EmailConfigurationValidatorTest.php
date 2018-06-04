<?php

namespace Test\Fei\Service\Connect\Common\Validator;

use Fei\Entity\Validator\Exception;
use Fei\Service\Connect\Common\Entity\Configuration\EmailConfiguration;
use Fei\Service\Connect\Common\Entity\Role;
use Fei\Service\Connect\Common\Transformer\Configuration\EmailConfigurationTransformer;
use Fei\Service\Connect\Common\Validator\EmailConfigurationValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailConfigurationValidatorTest
 *
 * @package Test\Fei\Service\Connect\Common\Validator
 */
class EmailConfigurationValidatorTest extends TestCase
{
    /**
     * @dataProvider dataEmailConfigurationValidate
     */
    public function testValidate($senderEmail, $senderName, $subjectPrefix, $bodySignature)
    {
        $validator = new EmailConfigurationValidator();

        $configuration = (new EmailConfiguration())
            ->setEmailSender($senderEmail)
            ->setEmailSenderName($senderName)
            ->setEmailSubjectPrefix($subjectPrefix)
            ->setEmailBodySignature($bodySignature);

        $this->assertTrue($validator->validate($configuration));

        $this->assertEmpty($validator->getErrors());
    }

    public function dataEmailConfigurationValidate()
    {
        return [
            [
                'sender@test.fr',
                'Test',
                'Subject prefix',
                'Body signature'
            ],
            [
                '',
                'Test',
                'Subject prefix',
                'Body signature'
            ],
            [
                'sender@test.fr',
                '',
                'Subject prefix',
                'Body signature'
            ],
            [
                'sender@test.fr',
                'Test',
                '',
                'Body signature'
            ],
            [
                'sender@test.fr',
                'Test',
                'Subject prefix',
                ''
            ],
            [
                '',
                '',
                '',
                ''
            ]
        ];
    }

    /**
     * @dataProvider dataEmailConfigurationNotValidate
     */
    public function testNotValidate($senderEmail, $senderName, $subjectPrefix, $bodySignature)
    {
        $validator = new EmailConfigurationValidator();

        $configuration = (new EmailConfiguration())
            ->setEmailSender($senderEmail)
            ->setEmailSenderName($senderName)
            ->setEmailSubjectPrefix($subjectPrefix)
            ->setEmailBodySignature($bodySignature);

        $this->assertFalse($validator->validate($configuration));

        $this->assertNotEmpty($validator->getErrors());
    }

    public function dataEmailConfigurationNotValidate()
    {
        return [
            [
                'sender',
                'Test',
                'Subject prefix',
                'Body signature'
            ],
            [
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'Test',
                'Subject prefix',
                'Body signature'
            ],
            [
                'sender@test.fr',
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'Subject prefix',
                'Body signature'
            ],
            [
                'sender@test.fr',
                'Test',
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'Body signature'
            ],
        ];
    }

    public function testValidateNoEmailConfigurationEntity()
    {
        $validator = new EmailConfigurationValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The Entity to validate must be an instance of ' . EmailConfiguration::class);

        $validator->validate(new Role());
    }

    public function testValidateSenderEmail()
    {
        $senderEmail = 'sender';

        $validator = new EmailConfigurationValidator();

        $this->assertFalse($validator->validateEmailSender($senderEmail));
        $this->assertEquals(
            'Sender email must be an email address',
            $validator->getErrors()[EmailConfigurationTransformer::EMAIL_SENDER][0]
        );

        // --------

        $senderEmail = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?';

        $validator = new EmailConfigurationValidator();

        $this->assertFalse($validator->validateEmailSender($senderEmail));
        $this->assertEquals(
            'Sender email length has to be less or equal to 255',
            $validator->getErrors()[EmailConfigurationTransformer::EMAIL_SENDER][0]
        );

        // --------

        $senderEmail = 'sender@test.fr';

        $validator = new EmailConfigurationValidator();

        $this->assertTrue($validator->validateEmailSender($senderEmail));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateSenderName()
    {
        $senderName = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?';

        $validator = new EmailConfigurationValidator();

        $this->assertFalse($validator->validateEmailSenderName($senderName));
        $this->assertEquals(
            'Sender name length has to be less or equal to 255',
            $validator->getErrors()[EmailConfigurationTransformer::EMAIL_SENDER_NAME][0]
        );

        // --------

        $senderName = 'Test';

        $validator = new EmailConfigurationValidator();

        $this->assertTrue($validator->validateEmailSenderName($senderName));
        $this->assertEmpty($validator->getErrors());
    }

    public function testValidateSubjectPrefix()
    {
        $subjectPrefix = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?';

        $validator = new EmailConfigurationValidator();

        $this->assertFalse($validator->validateEmailSubjectPrefix($subjectPrefix));
        $this->assertEquals(
            'Subject prefix length has to be less or equal to 255',
            $validator->getErrors()[EmailConfigurationTransformer::EMAIL_SUBJECT_PREFIX][0]
        );

        // --------

        $subjectPrefix = 'Subject prefix';

        $validator = new EmailConfigurationValidator();

        $this->assertTrue($validator->validateEmailSubjectPrefix($subjectPrefix));
        $this->assertEmpty($validator->getErrors());
    }
}
