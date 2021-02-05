<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

/**
 * Entity Phone
 *
 * @package NFSe\Entity
 */
class Phone extends AbstractEntity
{
    /**
     * Phone country code
     * @var int
     */
    private $coutryCode = 55;

    /**
     * Phone area code
     * @var int
     */
    private $areaCode;

    /**
     * Phone number
     * @var int
     */
    private $number;

    /**
     * Constructor
     *
     * @access public
     * @param int $countryCode
     * @param int $areaCode
     * @param int $number
     * @return \NFSe\Entity\Phone
     */
    public function __construct($countryCode = null, $areaCode = null, $number = null)
    {
        if (!empty($countryCode)) $this->setCountryCode($countryCode);
        if (!empty($areaCode)) $this->setAreaCode($areaCode);
        if (!empty($number)) $this->setNumber($number);

        return $this;
    }

    /**
     * Define country code
     * @param int $code
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Phone
     */
    public function setCountryCode($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException('Country code is empty!');
        }
        if (!is_numeric($code)) {
            throw new \InvalidArgumentException('Country code must be numeric!');
        }
        if (strlen($code) > 2) {
            throw new \InvalidArgumentException('Country code exceeds 2 numbers maximum length!');
        }
        $this->coutryCode = $code;

        return $this;
    }

    /**
     * Return country code
     * @return int
     */
    public function getCountryCode()
    {
        return $this->coutryCode;
    }

    /**
     * Define area code
     * @param int $code
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Phone
     */
    public function setAreaCode($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException('Area code is empty!');
        }
        if (!is_numeric($code)) {
            throw new \InvalidArgumentException('Area code must be numeric!');
        }
        if (strlen($code) > 2) {
            throw new \InvalidArgumentException('Area code exceeds 2 numbers maximum length!');
        }
        $this->areaCode = $code;

        return $this;
    }

    /**
     * Return area code
     * @return int
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Define area number
     * @param int $number
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Phone
     */
    public function setNumber($number)
    {
        if (empty($number)) {
            throw new \InvalidArgumentException('Number is empty!');
        }
        if (!is_numeric($number)) {
            throw new \InvalidArgumentException('Number must be numeric!');
        }
        if (strlen($number) > 10) {
            throw new \InvalidArgumentException('Number exceeds 2 numbers maximum length!');
        }
        $this->number = $number;

        return $this;
    }

    /**
     * Return area number
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Return area code with phone number
     * @return int
     */
    public function getPhone()
    {
        return $this->getAreaCode() . $this->getNumber();
    }

    /**
     * Return area number
     * @return string
     */
    public function getPhoneWithCountryCode()
    {
        return '+' . $this->getCountryCode() . $this->getPhone();
    }
}