<?php

namespace Fei\Service\Connect\Common\Cryptography;

use phpseclib\Crypt\RSA;
use phpseclib\File\X509;

/**
 * Class CertGen
 *
 * @package Fei\Service\Connect\Common\Crypt
 */
class X509CertificateGen
{
    /**
     * @var string Certificate validity
     */
    protected $certificateValidity = '+ 2 years';

    /**
     * @var array Certificate Distinguished Names (DN) X.509 properties
     */
    protected $dn = [
        'organizationName' => 'FEI',
        'commonName' => 'flash.global',
        'organizationalUnitName' => 'IT',
        'localityName' => 'Contern',
        'countryName' => 'LU'
    ];

    /**
     * Get CertValidity
     *
     * @return string
     */
    public function getCertificateValidity()
    {
        return $this->certificateValidity;
    }

    /**
     * Set CertValidity
     *
     * @param string $certificateValidity
     *
     * @return $this
     */
    public function setCertificateValidity($certificateValidity)
    {
        $this->certificateValidity = $certificateValidity;

        return $this;
    }

    /**
     * Get Dn
     *
     * @return array
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * Set Dn
     *
     * @param array $dn
     *
     * @return $this
     */
    public function setDn(array $dn)
    {
        $this->dn = $dn;

        return $this;
    }

    /**
     * Create a X.509 certificate
     *
     * @param string $privateKey
     *
     * @return string
     */
    public function createX509Certificate($privateKey)
    {
        $rsa = new RSA();
        $rsa->loadKey($privateKey);

        $issuer = new X509();
        $issuer->setPrivateKey($rsa);
        $issuer->setDN($this->getDn());

        $csr = new X509();
        $csr->setPrivateKey($rsa);
        $csr->setDN($issuer->getDN());

        $csr = $csr->saveCSR($csr->signCSR());

        $subject = new X509();
        $subject->loadCSR($csr);

        $x509 = new X509();
        $x509->setEndDate($this->getCertificateValidity());

        return $x509->saveX509($x509->sign($issuer, $subject));
    }
}
