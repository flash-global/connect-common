<?php

namespace Test\Fei\Service\Connect\Common\ProfileAssociation;

use Fei\Service\Connect\Common\ProfileAssociation\Message\UsernamePasswordMessage;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationMessageExtractor;
use Fei\Service\Connect\Common\ProfileAssociation\ProfileAssociationServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfileAssociationServerRequest
 *
 * @package Test\Fei\Service\Connect\Common\ProfileAssociation
 */
class ProfileAssociationServerRequestTest extends TestCase
{
    public function testProfileAssociationMessageExtractorAccessors()
    {
        $extractor = $this->getMockBuilder(ProfileAssociationMessageExtractor::class)->getMock();

        $request = new ProfileAssociationServerRequest();

        $request->setProfileAssociationMessageExtractor($extractor);

        $this->assertEquals($extractor, $request->getProfileAssociationMessageExtractor());
        $this->assertAttributeEquals(
            $request->getProfileAssociationMessageExtractor(),
            'profileAssociationMessageExtractor',
            $request
        );
    }

    public function testExtract()
    {
        $extractor = $this->getMockBuilder(ProfileAssociationMessageExtractor::class)->getMock();
        $extractor->expects($this->once())->method('extract')->willReturn(new UsernamePasswordMessage());

        $request = new ProfileAssociationServerRequest();

        $request->setProfileAssociationMessageExtractor($extractor);
        $request->extract('test');
    }
}
