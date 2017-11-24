<?php

namespace Test\Fei\Service\Connect\Common\Cryptography;

use Fei\Service\Connect\Common\Cryptography\RsaKeyGen;
use Fei\Service\Connect\Common\Cryptography\X509CertificateGen;
use phpseclib\File\X509;
use PHPUnit\Framework\TestCase;

/**
 * Class X509CertificateGen
 *
 * @package Test\Fei\Service\Connect\Common\Cryptography
 */
class X509CertificateGenTest extends TestCase
{
    public function testCertificateValidityAccessors()
    {
        $gen = new X509CertificateGen();

        $this->assertEquals('+ 2 years', $gen->getCertificateValidity());

        $gen->setCertificateValidity('+ 1 year');

        $this->assertEquals('+ 1 year', $gen->getCertificateValidity());
        $this->assertAttributeEquals($gen->getCertificateValidity(), 'certificateValidity', $gen);
    }

    public function testDnAccessor()
    {
        $gen = new X509CertificateGen();

        $this->assertEquals([
            'organizationName' => 'FEI',
            'commonName' => 'flash.global',
            'organizationalUnitName' => 'IT',
            'localityName' => 'Contern',
            'countryName' => 'LU'
        ], $gen->getDn());

        $gen->setDn([]);

        $this->assertEquals([], $gen->getDn());
        $this->assertAttributeEquals($gen->getDn(), 'dn', $gen);
    }

    public function testCreateX509Certificate()
    {
        $gen = new X509CertificateGen();

        $cert = $gen->createX509Certificate((new RsaKeyGen())->createPrivateKey());

        $this->assertRegExp(
            '/^(-----BEGIN CERTIFICATE-----)(\v.*)+(-----END CERTIFICATE-----)$/',
            $cert
        );

        $x509 = new X509();
        $x509->loadX509($cert);

        $this->assertEquals($gen->getDn()['organizationName'], $x509->getDNProp('organizationName')[0]);
        $this->assertEquals($gen->getDn()['commonName'], $x509->getDNProp('commonName')[0]);
        $this->assertEquals($gen->getDn()['organizationalUnitName'], $x509->getDNProp('organizationalUnitName')[0]);
        $this->assertEquals($gen->getDn()['localityName'], $x509->getDNProp('localityName')[0]);
        $this->assertEquals($gen->getDn()['countryName'], $x509->getDNProp('countryName')[0]);
    }
}
