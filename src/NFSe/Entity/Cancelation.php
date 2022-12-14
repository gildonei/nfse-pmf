<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

/**
 * Entity Cancelation
 *
 * @package NFSe\Entity
 */
class Cancelation extends AbstractEntity
{
    /**
     * Cancelation reason
     * @var string
     */
    private $reason = 55;

    /**
     * AEDF number
     * @var string
     */
    private $aedf;

    /**
     * Invoice number
     * @var int
     */
    private $invoiceNumber;

    /**
     * Verification code
     * @var string
     */
    private $verificationCode;

    /**
     * Constructor
     *
     * @access public
     * @param string $reason
     * @param string $aedf
     * @param int $invoiceNumber
     * @param int $verificationCode
     * @return \NFSe\Entity\Cancelation
     */
    public function __construct($reason = null, $aedf = null, $invoiceNumber = null, $verificationCode = null)
    {
        if (!empty($reason)) $this->setReason($reason);
        if (!empty($aedf)) $this->setAedf($aedf);
        if (!empty($invoiceNumber)) $this->setInvoiceNumber($invoiceNumber);
        if (!empty($verificationCode)) $this->setVerificationCode($verificationCode);
    }

    /**
     * Define cancelation reason
     * @param string $reason
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Cancelation
     */
    public function setReason($reason)
    {
        if (empty($reason)) {
            throw new \InvalidArgumentException('Cancelation reason is empty!');
        }
        if (strlen($reason) > 120) {
            throw new \InvalidArgumentException('Cancelation reason exceeds 120 maximum chars length!');
        }
        $this->reason = $reason;

        return $this;
    }

    /**
     * Return cancelation reason
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Define AEDF number
     * @param string $aedf
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Cancelation
     */
    public function setAedf($aedf)
    {
        if (empty($aedf)) {
            throw new \InvalidArgumentException('AEDF is empty!');
        }
        if (strlen($aedf) > 7) {
            throw new \InvalidArgumentException('AEDF exceeds 7 maximum chars length!');
        }
        $this->aedf = $aedf;

        return $this;
    }

    /**
     * Return AEDF number
     * @return string
     */
    public function getAedf()
    {
        return $this->aedf;
    }

    /**
     * Define invoice number
     * @param int $invoiceNumber
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Cancelation
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        if (empty($invoiceNumber)) {
            throw new \InvalidArgumentException('Invoice number is empty!');
        }
        if (!is_numeric($invoiceNumber)) {
            throw new \InvalidArgumentException('Invoice number must contain only numbers!');
        }
        if (strlen($invoiceNumber) > 7) {
            throw new \InvalidArgumentException('Invoice number exceeds 7 maximum digits length!');
        }
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Return invoice number
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Define verification code
     * @param string $verificationCode
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Cancelation
     */
    public function setVerificationCode($verificationCode)
    {
        if (empty($verificationCode)) {
            throw new \InvalidArgumentException('Verification code is empty!');
        }
        if (strlen($verificationCode) > 16) {
            throw new \InvalidArgumentException('Verification code exceeds 16 maximum chars length!');
        }
        $this->verificationCode = $verificationCode;

        return $this;
    }

    /**
     * Return verification code
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }
}