<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

/**
 * Entity Address
 *
 * @package NFSe\Entity
 */
class Address extends AbstractEntity
{
    /**
     * District
     * @var string
     */
    private $district;

    /**
     * Postal code
     * @var string
     */
    private $zipcode;

    /**
     * State
     * @var string
     */
    private $state;

    /**
     * City name
     * @var string
     */
    private $city;

    /**
     * Address name
     * @var string
     */
    private $street;

    /**
     * Address name
     * @var string
     */
    private $streetNumber;

    /**
     * IBGE city code
     * @var int
     */
    private $cityCode;

    /**
     * Address complement
     * @var string
     */
    private $complement;

    /**
     * Define district
     * @param string $district
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setDistrict($district)
    {
        if (empty($district)) {
            throw new \InvalidArgumentException('District is empty!');
        }
        if (strlen($district) > 60) {
            throw new \InvalidArgumentException('District exceeds maximum length 60 chars!');
        }
        $this->district = $district;

        return $this;
    }

    /**
     * Return district
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Define zip code
     * @param string $zipcode
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setZipcode($zipcode)
    {
        if (empty($zipcode)) {
            throw new \InvalidArgumentException('Zip code is empty!');
        }
        if (strlen($zipcode) > 10) {
            throw new \InvalidArgumentException('Zip code exceeds 10 chars length!');
        }
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Return zip code
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Define state city
     * @param string $state
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setState($state)
    {
        if (empty($state)) {
            throw new \InvalidArgumentException('State is empty!');
        }
        if (strlen($state) != 2) {
            throw new \InvalidArgumentException('State must have 2 chars length!');
        }
        $state = strtolower($state);
        if (!in_array($state, ['AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO'])) {
            throw new \InvalidArgumentException('State is invalid!');
        }
        $this->state = $state;

        return $this;
    }

    /**
     * Return state
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Define city name
     * @param string $city
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setCity($city)
    {
        if (empty($city)) {
            throw new \InvalidArgumentException('City is empty!');
        }
        if (strlen($city) > 60) {
            throw new \InvalidArgumentException('City exceeds 60 chars length!');
        }
        $this->city = $city;

        return $this;
    }

    /**
     * Return city name
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Define street name
     * @param string $street
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setStreet($street)
    {
        if (empty($street)) {
            throw new \InvalidArgumentException('Street is empty!');
        }
        if (strlen($street) > 60) {
            throw new \InvalidArgumentException('Street name exceeds 60 chars length!');
        }
        $this->street = $street;

        return $this;
    }

    /**
     * Return street name
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Define streetNumber name
     * @param string $streetNumber
     * @throws \InvalidArgumentException
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        if (empty($streetNumber)) {
            throw new \InvalidArgumentException('Street Number is empty!');
        }
        if (strlen($streetNumber) > 9) {
            throw new \InvalidArgumentException('Street Number exceeds 9 chars length!');
        }
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Return streetNumber name
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Define IBGE cityCode
     * @param int $cityCode
     * @return Address
     */
    public function setCityCode($cityCode)
    {
        if (empty($cityCode)) {
            throw new \InvalidArgumentException('City code is empty!');
        }
        if (!is_numeric($cityCode)) {
            throw new \InvalidArgumentException('City code must be numeric!');
        }
        $this->cityCode = $cityCode;

        return $this;
    }

    /**
     * Return address complement
     * @return string
     */
    public function getCityCode()
    {
        return $this->cityCode;
    }

    /**
     * Define address complement
     * @param string $complement
     * @return Address
     */
    public function setComplement($complement)
    {
        if (strlen($complement) > 30) {
            throw new \InvalidArgumentException('Address complement exceeds 30 char length!');
        }
        $this->complement = $complement;

        return $this;
    }

    /**
     * Return address complement
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }
}
